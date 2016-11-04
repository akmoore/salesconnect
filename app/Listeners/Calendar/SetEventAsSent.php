<?php

namespace App\Listeners\Calendar;

use App\Events\EmailCalendarEventOneDayOut;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Calendar;

class SetEventAsSent
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
     * @param  EmailCalendarEventOneDayOut  $event
     * @return void
     */
    public function handle(EmailCalendarEventOneDayOut $event)
    {
        $calendar = $this->calendar->whereId($event->event->id);
        $calendar->update(['emailed' => 1, 'emailed_at' => \Carbon\Carbon::now('America/Chicago')]);
        // dd($calendar);
    }
}
