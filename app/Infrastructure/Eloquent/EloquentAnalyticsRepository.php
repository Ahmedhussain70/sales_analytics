<?php

namespace App\Infrastructure\Eloquent;

use App\Application\Interfaces\AnalyticsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EloquentAnalyticsRepository implements AnalyticsRepositoryInterface
{
    public function updateTotalSales(float $amount): void
    {
        DB::table('orders')->updateOrInsert(
            ['type' => 'total_sales'],
            ['value' => DB::raw('value + ' . $amount)]
        );
    }

    public function incrementOrderCount(): void
    {
        DB::table('orders')->updateOrInsert(
            ['type' => 'order_count'],
            ['value' => DB::raw('value + 1')]
        );
    }

    public function updateOrderStatusCount(string $status): void
    {
        DB::table('orders')->updateOrInsert(
            ['type' => "order_status_{$status}"],
            ['value' => DB::raw('value + 1')]
        );
    }

    public function getAnalytics(): array
    {
        return DB::table('orders')->join('products', 'orders.product_id', '=', 'products.id')
            ->select('products.name', 'orders.quantity', 'orders.created_at')
            ->groupBy('products.name')
            ->orderBy('orders.quantity', 'desc')
            ->get()->toArray();
    }

    public function getTotalRevenue(): float
    {
        return DB::table('orders')->join('products', 'orders.product_id', '=', 'products.id')
        ->select(DB::raw('SUM(orders.quantity * products.price) as total_amount'))
        ->value('total_amount');
    }

    public function getTopProductsBySales(int $limit): array
    {
        return DB::table('orders')->join('products', 'orders.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    public function getRevenueInLastMinute(): float
    {
        return DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->where('orders.created_at', '>=', now()->subMinute())
        ->sum('products.price');
    }

    public function getOrderCountInLastMinute(): int
    {
        return DB::table('orders')
            ->where('created_at', '>=', now()->subMinute())
            ->count();
    }
}
