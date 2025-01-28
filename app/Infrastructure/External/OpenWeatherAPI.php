<?php

namespace App\Infrastructure\External;

use Illuminate\Support\Facades\Http;

class OpenWeatherAPI
{
    // protected $apiKey;

    // public function __construct()
    // {
    //     $this->apiKey = config('services.openweather.key');
    // }

    public static function getWeather(string $city)
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => config('services.openweather.key'),
            'units' => 'metric',
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch weather data');
        }

        $data = $response->json();

        return [
            'temperature' => $data['main']['temp'],
            'condition' => $data['weather'][0]['description'],
            'city' => $data['name'],
        ];
    }
}
