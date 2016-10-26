<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

// use App\Calendar;

class EmailCalendarEventOneDayOut
{
    use InteractsWithSockets, SerializesModels;

    public $event;
    public $recipients;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($event, $recipients)
    {
        $this->event = $event;
        $this->recipients = $recipients;
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
