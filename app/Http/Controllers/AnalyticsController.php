<?php

namespace App\Http\Controllers;

use App\Events\UpdatedAnalyticsEvent;
use App\Http\Services\analyticsRepository;
use App\Infrastructure\Eloquent\EloquentAnalyticsRepository;

class AnalyticsController extends Controller
{
    protected $analyticsRepository;

    /**
     * Constructor to inject analyticsRepository.
     *
     * @param analyticsRepository $analyticsRepository
     */
    public function __construct(EloquentAnalyticsRepository $analyticsRepository)
    {
        $this->analyticsRepository = $analyticsRepository;
    }

    /**
     * Get real-time analytics data.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $analytics = $this->analyticsRepository->getAnalytics();
        $totalRevenue = $this->analyticsRepository->getTotalRevenue();
        $topProducts = $this->analyticsRepository->getTopProductsBySales(5);
        $revenueLastMinute = $this->analyticsRepository->getRevenueInLastMinute();
        $ordersLastMinute = $this->analyticsRepository->getOrderCountInLastMinute();

        $data = [
            'analytics' => $analytics,
            'total_revenue' => $totalRevenue,
            'top_products' => $topProducts,
            'revenue_last_minute' => $revenueLastMinute,
            'orders_last_minute' => $ordersLastMinute,
        ];

        broadcast(new UpdatedAnalyticsEvent($data));
        return response()->json($data);
    }
}
