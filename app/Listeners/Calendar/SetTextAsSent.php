<?php

namespace App\Listeners\Calendar;

use App\Events\TextCalendarEventOneHourOut;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Calendar;

class SetTextAsSent
{
    protected $calendar;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    /**
     * Handle the event.
     *
     * @param  TextCalendarEventOneHourOut  $event
     * @return void
     */
    public function handle(TextCalendarEventOneHourOut $event)
    {
        $calendar = $this->calendar->whereId($event->event->id);
        $calendar->update(['texted' => 1, 'texted_at' => \Carbon\Carbon::now('America/Chicago')]);
    }
}
