<?php

namespace App\Events\YouTube;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class YoutubeVideoAdded
{
    use InteractsWithSockets, SerializesModels;

    public $youtube;
    public $project;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($youtube, $project)
    {
        $this->youtube = $youtube;
        $this->project = $project;
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
