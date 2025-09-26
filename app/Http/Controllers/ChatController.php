<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $query = $request->input('message');

        // API URL & Key của Gemini
        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";
        $apiKey = env('GEMINI_API_KEY');

        // Gửi request đến Gemini API
        try {
            $response = Http::post("{$apiUrl}?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [['text' => "hãy tưởng tượng bạn là 1 nhân viên bán máy tính 
                                                tư vấn theo câu hỏi khách hàng, nhớ hãy tư vấn ngắn gọn đủ dùng nhưng
                                                vẫn tình cảm nhé: \nCâu hỏi: {$query}"]]
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
