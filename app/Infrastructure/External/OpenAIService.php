<?php

namespace App\Infrastructure\External;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    // protected $apiKey;

    // public function __construct()
    // {
    //     $this->apiKey = config('services.openai.key');
    // }

    // public static function generateRecommendations(string $prompt)
    // {
    //     $response = Http::post('https://api.openai.com/v1/completions', [
    //         'model' => 'text-davinci-003',
    //         'prompt' => $prompt,
    //         'max_tokens' => 150,
    //     ], [
    //         'Authorization' => 'Bearer ' . config('services.openai.key'),
    //     ]);

    //     if ($response->failed()) {
    //         throw new \Exception('Failed to fetch AI recommendations');
    //     }

    //     return $response->json()['choices'][0]['text'];
    // }

    public static function generateRecommendations(string $prompt)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.key'),
        ])->post('https://api.openai.com/v1/chat/completions', [ // Updated endpoint
            'model' => 'gpt-3.5-turbo', // Use `gpt-4` or `gpt-3.5-turbo`
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'], // System role (optional)
                ['role' => 'user', 'content' => $prompt], // User role with the prompt
            ],
            'max_tokens' => 200,
            'temperature' => 0.7,
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch AI recommendations: ' . $response->body());
        }

        // Return the generated text
        return $response->json()['choices'][0]['message']['content'];
    }
}
