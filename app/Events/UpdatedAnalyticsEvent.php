<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdatedAnalyticsEvent
{
    use Dispatchable, SerializesModels;

    public $analytics;

    public function __construct($analytics)
    {
        $this->analytics = $analytics;
    }

    public function broadcastOn()
    {
        return new Channel('analytics');
    }
}
