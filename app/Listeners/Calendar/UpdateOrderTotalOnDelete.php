<?php

namespace App\Listeners\Calendar;

use App\Events\CalendarEventDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order;
use App\Project;
use App\SalesConnect\Helpers\OrderHelperTrait;

class UpdateOrderTotalOnDelete
{
    use OrderHelperTrait;

    protected $order;
    protected $project;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Order $order, Project $project)
    {
        $this->order = $order;
        $this->project = $project;
    }

    /**
     * Handle the event.
     *
     * @param  CalendarEventCreated  $event
     * @return void
     */
    public function handle(CalendarEventDeleted $event)
    {
        // dd($event);
        $project = $this->project->with('events')->find($event->event->project_id);
        $order = $this->order->where('project_id', '=', $event->event->project_id)->first();

        $totalOrder = $this->getTotalWorkAmount($project, $order);

        return $order->update(['order_total' => $totalOrder]);
    }
}
