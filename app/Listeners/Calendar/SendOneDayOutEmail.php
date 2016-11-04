<?php

namespace App\Listeners\Calendar;

use Mail;
use App\Events\EmailCalendarEventOneDayOut;
use App\Mail\EventReminderEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Calendar;
use App\Project;

class SendOneDayOutEmail implements ShouldQueue
{
    protected $calendar;
    protected $project;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Calendar $calendar, Project $project)
    {
        $this->calendar = $calendar;
        $this->project = $project;
    }

    /**
     * Handle the event.
     *
     * @param  EmailCalendarEventOneDayOut  $event
     * @return void
     */
    public function handle(EmailCalendarEventOneDayOut $event)
    {
        $emails = $this->getRecipientsInfo($event->recipients, 'email');
        $names = $this->getRecipientsInfo($event->recipients, 'name');
        $combine = $names->combine($emails);
        $project = $this->project->whereId($event->event->project_id)->first();

        // $dumpArray = [];
        // dd($event->event->id);

        // $calendar = $this->calendar->find($event->event->id);
        // $calendar->emailed = 1;
        // $calendar->emailed_at = Carbon\Carbon::now();
        // $calendar->save();

        foreach($combine as $name => $email){
            \Mail::to($email)->queue(new EventReminderEmail($event->event, $name, $project));

            // dd($event->event->emailed);

            // $event->event->emailed = 1;
            // $event->event->emailed_at = Carbon\Carbon::now();
            // $event->event->save();
        }

        // $calendar = $this->calendar->find($event->event->id);
        // $calendar->emailed = 1;
        // $calendar->emailed_at = Carbon\Carbon::now();
        // $calendar->save();
        
    }

    public function getRecipientsInfo($rCollection, $info){
        return $rCollection->map(function($r) use ($info) {return is_array([$r][0]) ? [$r][0][$info] : [$r][0]->map(function($ae) use ($info){return [$ae][0][$info];});})->flatten()->filter(function($recipient){return $recipient != null;});
    }
}
