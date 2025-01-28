<?php

namespace App\Events\Listeners;

// use App\Events\OrderCreated;
// use App\Http\Services\AnalyticsService;

use App\Events\UpdatedAnalyticsEvent;
use App\Infrastructure\Eloquent\EloquentAnalyticsRepository;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateAnalyticsListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $analyticsRepository;

    public function __construct(EloquentAnalyticsRepository $analyticsRepository)
    {
        $this->analyticsRepository = $analyticsRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UpdatedAnalyticsEvent  $event
     * @return void
     */
    public function handle(UpdatedAnalyticsEvent $event)
    {
        $analytics = $this->analyticsRepository->getAnalytics();
        broadcast(new UpdatedAnalyticsEvent($analytics));
    }

    public function broadcastOn()
    {
        return new Channel('analytics');
    }
}
