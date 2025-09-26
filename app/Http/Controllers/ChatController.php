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

        // Lấy thông tin sản phẩm từ database để cung cấp context cho AI
        $storeContext = $this->productService->getStoreContext();
        
        // Kiểm tra nếu khách hàng hỏi về sản phẩm cụ thể
        $specificProducts = null;
        if (preg_match('/laptop|macbook|gaming|văn phòng/i', $query)) {
            $specificProducts = $this->productService->searchProducts($query, 3);
        }

        // API URL & Key của Gemini
        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";
        $apiKey = env('GEMINI_API_KEY');

        // Tạo prompt với context từ database
        $prompt = "BẠN LÀ NHÂN VIÊN TƯ VẤN MÁY TÍNH:\n\n";
        $prompt .= $storeContext . "\n\n";
        
        if ($specificProducts && $specificProducts->count() > 0) {
            $prompt .= "SẢN PHẨM LIÊN QUAN:\n";
            foreach ($specificProducts as $product) {
                $price = $product->sale_price > 0 ? number_format($product->sale_price) : number_format($product->price);
                $prompt .= "- {$product->name} - Giá: {$price}đ - Còn: {$product->stock_quantity} sản phẩm\n";
            }
            $prompt .= "\n";
        }
        
        $prompt .= "HÃY TƯ VẤN CHO KHÁCH HÀNG THEO CÂU HỎI SAU (trả lời ngắn gọn, tình cảm và dựa trên sản phẩm có sẵn):\n";
        $prompt .= "Câu hỏi: {$query}";

        // Gửi request đến Gemini API
        try {
            $response = Http::post("{$apiUrl}?key={$apiKey}", [
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
                } else {
                    $reply = "Xin lỗi, có lỗi xảy ra khi xử lý phản hồi từ AI.";
                }
            } else {
                $reply = "Xin lỗi, không thể kết nối với dịch vụ AI.";
            }
        } catch (\Exception $e) {
            Log::error('ChatBot API error', [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            
            // Xử lý lỗi quota exceeded
            if (strpos($e->getMessage(), 'quota') !== false || strpos($e->getMessage(), '429') !== false) {
                $reply = "Chatbot hiện tại đã vượt quá giới hạn sử dụng. Vui lòng thử lại sau 24h.";
            } else {
                $reply = "Xin lỗi, có lỗi xảy ra khi giao tiếp với dịch vụ AI.";
            }
        }

        return response()->json(['reply' => $reply]);
    }
}
