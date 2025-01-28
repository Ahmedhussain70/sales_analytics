<?php

namespace App\Infrastructure\Eloquent;

use App\Application\Interfaces\OrderRepositoryInterface;
use App\Infrastructure\External\OpenAIService;
use Illuminate\Support\Facades\DB;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function create(array $data)
    {
        return DB::table('orders')->insertGetId($data);
    }

    public function findById(int $id)
    {
        return DB::table('orders')->where('id', $id)->first();
    }

    public function getAll()
    {
        return DB::table('orders')->get();
    }

    public function getRecentSales()
    {
        return DB::table('orders')
            ->orderBy('created_at', 'desc')
            ->limit(10) // Fetch recent 10 sales records
            ->get()
            ->toArray();
    }

    public function generateRecommendations($prompt)
    {
        // Call the AI service to generate recommendations
        $recommendations = OpenAIService::generateRecommendations($prompt);

        // Return the recommendations
        return $recommendations;
    }
}
