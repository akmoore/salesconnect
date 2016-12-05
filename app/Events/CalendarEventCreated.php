<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CalendarEventCreated
{
    use InteractsWithSockets, SerializesModels;

    public $event;
    public $project;
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($event, $project, $request)
    {
        $this->event = $event;
        $this->project = $project;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
