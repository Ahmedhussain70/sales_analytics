<?php
namespace App\Events\Broadcasters;

use Illuminate\Support\Facades\Broadcast;

class WebSocketBroadcaster
{
    public function broadcastOrderCreated($order)
    {
        Broadcast::channel('orders', function () use ($order) {
            return $order;
        });
    }
}
