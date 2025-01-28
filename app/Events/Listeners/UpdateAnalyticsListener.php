<?php
namespace App\Events\Listeners;

use App\Events\OrderCreated;
use App\Http\Services\AnalyticsService;

class UpdateAnalyticsListener
{
    protected $analyticsService;

    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    public function handle(OrderCreated $event)
    {
        // Update analytics after an order is created
        $order = $event->orderId;
        // Call the analytics service to update the analytics
        $this->analyticsService->updateAnalyticsForOrder($order);
    }
}
?>
