<?php

namespace App\Listeners;

use App\Events\ProjectWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateInitialOrder
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
     * @param  ProjectWasCreated  $event
     * @return void
     */
    public function handle(ProjectWasCreated $event)
    {
        $order = $event->project->order()->save(new \App\Order());
        $order->produced_by = $event->project->air_date;
        $order->save();
    }
}
