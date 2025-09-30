<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\ProductService;

class ChatController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function chat(Request $request)
    {
        $query = $request->input('message');
        if (!$query || !is_string($query)) {
            return response()->json(['reply' => 'Bạn hãy nhập câu hỏi để mình tư vấn nhé.']);
        }
        // Nhận lịch sử hội thoại ngắn từ client (không lưu server; chỉ để giữ ngữ cảnh tạm thời)
        $history = $request->input('history', []);
        $historyLines = [];
        if (is_array($history)) {
            // Chỉ lấy tối đa 6 tin nhắn gần nhất (3 lượt trao đổi)
            $slice = array_slice($history, -6);
            foreach ($slice as $item) {
                if (!is_array($item) || empty($item['text'])) continue;
                $sender = isset($item['sender']) && $item['sender'] === 'bot' ? 'Trợ lý' : 'Khách';
                // Cắt gọn từng dòng để tránh prompt quá dài
                $text = trim((string) $item['text']);
                if (mb_strlen($text) > 200) {
                    $text = mb_substr($text, 0, 200) . '…';
                }
                $historyLines[] = "{$sender}: {$text}";
            }
        }

        // Lấy thông tin sản phẩm từ database để cung cấp context cho AI
        try {
            $storeContext = $this->productService->getStoreContext();
        } catch (\Throwable $e) {
            Log::warning('Get store context failed for chatbot', ['error' => $e->getMessage()]);
            $storeContext = "Hiện tại mình có nhiều mẫu laptop/PC văn phòng và gaming có sẵn. Bạn muốn nhu cầu như chơi game, làm việc văn phòng hay đồ họa?";
        }
        
        // Kiểm tra nếu khách hàng hỏi về sản phẩm cụ thể
        $specificProducts = null;
        if (preg_match('/laptop|macbook|gaming|văn phòng/i', $query)) {
            $specificProducts = $this->productService->searchProducts($query, 3);
        }

        // API URL & Key của Gemini
        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";
        $apiKey = env('GEMINI_API_KEY');
        if (empty($apiKey)) {
            // Graceful local fallback: suggest from our catalog instead of failing
            Log::warning('GEMINI_API_KEY missing for chatbot');
            try {
                $suggest = $specificProducts;
                if (!$suggest || $suggest->count() === 0) {
                    $suggest = $this->productService->getFeaturedProducts(3);
                }
                if ($suggest && $suggest->count() > 0) {
                    $lines = [
                        "Mình chưa kết nối được AI đám mây, nhưng có vài gợi ý cho bạn:" 
                    ];
                    foreach ($suggest as $p) {
                        $price = $p->sale_price > 0 ? $p->sale_price : $p->price;
                        $cat = $p->category_name ?? ($p->category?->name ?? '');
                        $brand = $p->brand ? (" | ".$p->brand) : '';
                        $lines[] = "• {$p->name}{$brand}" . ($cat ? " | {$cat}" : '') . " | Giá: " . number_format($price) . "đ";
                    }
                    $lines[] = "Bạn có thể mô tả rõ hơn nhu cầu (gaming, văn phòng, đồ họa) để mình lọc chính xác hơn nhé.";
                    return response()->json(['reply' => implode("\n", $lines)], 200);
                }
            } catch (\Throwable $e) {
                // ignore and fall through
            }
            return response()->json(['reply' => 'Chatbot tạm thời không kết nối được AI. Bạn cho mình biết nhu cầu (gaming/văn phòng/đồ họa) và tầm giá để mình gợi ý nhanh nhé.'], 200);
        }

        // Tạo prompt với context từ database và lịch sử hội thoại ngắn
        $prompt = "BẠN LÀ NHÂN VIÊN TƯ VẤN MÁY TÍNH:\n\n";
        if (!empty($historyLines)) {
            $prompt .= "LỊCH SỬ CUỘC HỘI THOẠI GẦN ĐÂY (để giữ ngữ cảnh):\n";
            $prompt .= implode("\n", $historyLines) . "\n\n";
        }
    $prompt .= $storeContext . "\n\n";
        
        if ($specificProducts && $specificProducts->count() > 0) {
            $prompt .= "SẢN PHẨM LIÊN QUAN:\n";
            foreach ($specificProducts as $product) {
                $price = $product->sale_price > 0 ? number_format($product->sale_price) : number_format($product->price);
                $prompt .= "- {$product->name} - Giá: {$price}đ - Còn: {$product->stock_quantity} sản phẩm\n";
            }
            $prompt .= "\n";
        }
        
    $prompt .= "HÃY TƯ VẤN CHO KHÁCH HÀNG THEO CÂU HỎI SAU (trả lời ngắn gọn, ấm áp, nhất quán với lịch sử, và chỉ dựa trên sản phẩm có sẵn):\n";
        $prompt .= "Câu hỏi: {$query}";

        // Gửi request đến Gemini API
        try {
            // Clip prompt to a safe size bound (~3500 chars) to avoid token overflow
            if (mb_strlen($prompt) > 3500) {
                $prompt = mb_substr($prompt, 0, 3500) . "\n…";
            }

            $httpClient = Http::timeout(12);
            $verify = env('GEMINI_SSL_VERIFY', true);
            $caBundle = env('GEMINI_CA_BUNDLE');
            if (!empty($caBundle)) {
                $httpClient = $httpClient->withOptions(['verify' => $caBundle]);
            } elseif (is_string($verify) ? filter_var($verify, FILTER_VALIDATE_BOOLEAN) === false : $verify === false) {
                $httpClient = $httpClient->withoutVerifying();
            }

            $response = $httpClient->post("{$apiUrl}?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [['text' => $prompt]]
                    ]
                ]
            ]);

            // Kiểm tra nếu request thành công
            if ($response->successful()) {
                $data = $response->json();
                
                // Kiểm tra phản hồi hợp lệ
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $reply = $data['candidates'][0]['content']['parts'][0]['text'];
                    if (mb_strlen($reply) > 1200) {
                        $reply = mb_substr($reply, 0, 1200) . '…';
                    }
                } else {
                    $reply = "Xin lỗi, có lỗi xảy ra khi xử lý phản hồi từ AI.";
                }
            } else {
                $status = $response->status();
                $body = $response->body();
                Log::warning('ChatBot API non-2xx response', ['status' => $status, 'body' => $body]);
                if (stripos($body, 'SSL certificate problem') !== false || stripos($body, 'curl error 60') !== false) {
                    $reply = "Máy chủ không thể xác thực chứng chỉ SSL khi gọi Gemini. Vui lòng cập nhật bộ chứng chỉ CA hoặc tạm thời đặt GEMINI_SSL_VERIFY=false cho môi trường nội bộ.";
                } else if ($status === 401 || $status === 403 || stripos($body, 'unauthorized') !== false || stripos($body, 'forbidden') !== false) {
                    $reply = "Khóa API Gemini không hợp lệ hoặc bị hạn chế quyền. Vui lòng kiểm tra lại cấu hình GEMINI_API_KEY.";
                } else if ($status === 429 || stripos($body, 'quota') !== false) {
                    $reply = "Chatbot hiện tại đã vượt quá giới hạn sử dụng. Vui lòng thử lại sau 24h.";
                } else if ($status >= 500 && $status < 600) {
                    // Thử lại 1 lần nhanh cho lỗi tạm thời
                    try {
                        $retryClient = $httpClient->timeout(10);
                        $retry = $retryClient->post("{$apiUrl}?key={$apiKey}", [
                            'contents' => [[ 'parts' => [['text' => $prompt]] ]]
                        ]);
                        if ($retry->successful()) {
                            $data = $retry->json();
                            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                            if (!$reply) {
                                $reply = "Xin lỗi, có lỗi xảy ra khi xử lý phản hồi từ AI.";
                            }
                        } else {
                            $reply = "Xin lỗi, không thể kết nối với dịch vụ AI.";
                        }
                    } catch (\Throwable $e2) {
                        $reply = "Xin lỗi, không thể kết nối với dịch vụ AI.";
                    }
                } else {
                    $reply = "Xin lỗi, không thể kết nối với dịch vụ AI.";
                }
            }
        } catch (\Exception $e) {
            Log::error('ChatBot API error', [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            
            // Xử lý lỗi quota exceeded
            $message = $e->getMessage();
            if (stripos($message, 'SSL certificate problem') !== false || stripos($message, 'cURL error 60') !== false) {
                $reply = "Không thể xác thực chứng chỉ SSL khi kết nối Gemini. Bạn hãy tải/cập nhật file CA (cacert.pem) và đặt đường dẫn vào GEMINI_CA_BUNDLE, hoặc tạm đặt GEMINI_SSL_VERIFY=false trên môi trường local.";
            } else if (strpos($message, 'quota') !== false || strpos($message, '429') !== false) {
                $reply = "Chatbot hiện tại đã vượt quá giới hạn sử dụng. Vui lòng thử lại sau 24h.";
            } else if (strpos($message, 'timed out') !== false) {
                $reply = "Hệ thống đang chậm. Bạn vui lòng thử lại sau ít phút nhé.";
            } else {
                $reply = "Xin lỗi, có lỗi xảy ra khi giao tiếp với dịch vụ AI.";
            }
        }

        return response()->json(['reply' => $reply]);
    }
}
