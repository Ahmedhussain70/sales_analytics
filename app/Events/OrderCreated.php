<?php
namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class OrderCreated
{
    use Dispatchable;

    public $orderId;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }
}
