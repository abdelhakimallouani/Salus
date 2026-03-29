<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function healthAdvice(){

        $symptoms = Auth::user()->symptoms()->latest()->take(5)->pluck('description')->toArray();

        if(empty($symptoms)) {
            return response()->json([
                'success' => false,
                'message' => 'No symptoms'
            ], 400);
        }

        $prompt = "You are a health assistant. Provide general wellness advice only, no diagnosis.\n\nUser symptoms:\n"
            . implode("\n", $symptoms);

        try {
            $response = Http::withOptions([
                'verify'=>false
            ])->post(
"https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=" . env('GEMINI_API_KEY'),
                [
                    "contents" => [
                        [
                            "parts" => [
                                ["text" => $prompt]
                            ]
                        ]
                    ]
                ]
            );

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'AI service error',
                    'status' => $response->json(),
                    'status_code' => $response->status()
                ], 500);
            }

            $data = $response->json();

            $advice = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No advice';

            return response()->json([
                'success' => true,
                'data' => [
                    'advice' => $advice,
                    'generated_at' => now()
                ],
                'message' => 'AI advice generated'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
