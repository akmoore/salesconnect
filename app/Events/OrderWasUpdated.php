<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderWasUpdated
{
    use InteractsWithSockets, SerializesModels;

    public $oldOrder;
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($oldOrder, $request)
    {
        $this->oldOrder = $oldOrder;
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
