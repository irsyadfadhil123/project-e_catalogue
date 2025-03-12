<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeminiService
{
    public function postGenerate($category)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
            'contents' => [
                [
                    'parts' => [
                        ['text' => 'I have a online catalog website that can give a promotion about the product category. generate a paragraph of promotion in ' . $category . ' product at most 100 words. Do not add option, discount promotion, and anything that need an input']
                    ]
                ]
            ]
        ]);

        return $response->successful() ? $response->json() : [];
    }
}
