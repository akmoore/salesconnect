<?php

namespace App\Listeners\YouTube;

use App\Events\YouTube\YoutubeVideoAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetISCI
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  YoutubeVideoAdded  $event
     * @return void
     */
    public function handle(YoutubeVideoAdded $event)
    {
        //
    }
}
