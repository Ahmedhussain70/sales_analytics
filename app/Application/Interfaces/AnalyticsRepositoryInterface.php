<?php
namespace App\Application\Interfaces;

interface AnalyticsRepositoryInterface
{
    public function updateTotalSales(float $amount): void;

    public function incrementOrderCount(): void;

    public function updateOrderStatusCount(string $status): void;

    public function getAnalytics(): array;

    public function getTotalRevenue(): float;
    public function getTopProductsBySales(int $limit): array;
    public function getRevenueInLastMinute(): float;
    public function getOrderCountInLastMinute(): int;
}
