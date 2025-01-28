<?php

namespace App\Http\Controllers;

use App\Application\UseCases\GetWeatherBasedRecommendations;
use App\Infrastructure\Eloquent\EloquentProductRepository;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $productRepository;

    public function __construct(EloquentProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function recommendations(Request $request)
    {
        try {
            $city = $request->input('q');

            $weatherData = $this->productRepository->getRecommendationsWeather($city);

            // Check if the weather data is valid
            // if (empty($weatherData) || !isset($weatherData['weather'][0]['main'])) {
            //     throw new \Exception('Invalid weather data received.');
            // }

            $condition = strtolower($weatherData['condition']); // Corrected to access weather condition
            $recommendations = [];

            $basePrice = 1;
            $dynamicPrice = $this->calculateDynamicPricing($weatherData, $basePrice);

            if (str_contains($condition, 'rain')) {
                $recommendations = $this->productRepository->findByCategory('Rain Gear');
            } elseif (str_contains($condition, 'hot')) {
                $recommendations = $this->productRepository->findByCategory('Cooling Products');
            } elseif (str_contains($condition, 'clear sky') || str_contains($condition, 'broken clouds') || str_contains($condition, 'mist')) {
                $recommendations = $this->productRepository->findByCategory('Warm Clothing');
            }

            foreach ($recommendations as $product) {
                $product->price = $dynamicPrice;
            }

            return [
                'weather' => $weatherData,
                'recommendations' => $recommendations,
            ];
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    private function calculateDynamicPricing($weatherData, $basePrice)
    {
        $temperature = strtolower($weatherData['temperature']);
        $weatherCondition = $weatherData['condition'];

        $temperatureCelsius = $temperature - 273.15;

        if ($temperatureCelsius < 0) {
            $priceAdjustment = 1.15;
        } elseif ($temperatureCelsius > 30) {
            $priceAdjustment = 1.20;
        } else {
            $priceAdjustment = 1.00;
        }

        switch ($weatherCondition) {
            case 'Rain':
            case 'Snow':

                $priceAdjustment *= 1.10;
                break;
            case 'Clear':
                $priceAdjustment *= 0.90;
                break;
        }

        $currentMonth = date('m');
        if (in_array($currentMonth, [12, 6, 7, 8])) {
            $priceAdjustment *= 1.25;
        }

        return $basePrice * $priceAdjustment;
    }
}
