<?php

namespace App\Events\Listeners;

use App\Events\OrderCreated;
use App\Events\Broadcasters\WebSocketBroadcaster;

class NotifyFrontendListener
{
    protected $broadcaster;

    public function __construct(WebSocketBroadcaster $broadcaster)
    {
        $this->broadcaster = $broadcaster;
    }

    public function handle(OrderCreated $event)
    {
        $orderId = $event->orderId;

        // Example: Broadcast order creation to a WebSocket channel
        $this->broadcaster->broadcastOrderCreated([
            'message' => "Order #{$orderId} created successfully",
            'orderId' => $orderId,
        ]);
    }
}
