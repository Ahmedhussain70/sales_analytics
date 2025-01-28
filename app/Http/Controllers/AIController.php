<?php

namespace App\Http\Controllers;

use App\Infrastructure\Eloquent\EloquentOrderRepository;

class AIController extends Controller
{
    protected $orderRepository;

    public function __construct(EloquentOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getRecommendations()
    {
        $salesData = $this->orderRepository->getRecentSales();

        // Construct the AI prompt
        $prompt = "Given this sales data, which products should we promote for higher revenue?\n\n" . json_encode($salesData);

        // Use the AI service to generate recommendations
        return $this->orderRepository->generateRecommendations($prompt);
    }

}
