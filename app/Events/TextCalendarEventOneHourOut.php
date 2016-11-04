<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TextCalendarEventOneHourOut
{
    use InteractsWithSockets, SerializesModels;

    public $phone_numbers;
    public $event;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($event, $phone_numbers)
    {
        $this->event = $event;
        $this->phone_numbers = $phone_numbers;
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
