<?php

namespace App\Events\Project;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LogActivity
{
    use InteractsWithSockets, SerializesModels;

    public $table;
    public $event;
    public $object;
    public $list;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($table, $event, $object, $list = null)
    {
        $this->table = $table;
        $this->event = $event;
        $this->object = $object;
        $this->list = $list;
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
