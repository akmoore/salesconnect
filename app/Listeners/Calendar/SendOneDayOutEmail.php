<?php

namespace App\Listeners\Calendar;

use Mail;
use App\Events\EmailCalendarEventOneDayOut;
use App\Mail\EventReminderEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOneDayOutEmail implements ShouldQueue
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
     * @param  EmailCalendarEventOneDayOut  $event
     * @return void
     */
    public function handle(EmailCalendarEventOneDayOut $event)
    {
        $emails = $this->getRecipientsInfo($event->recipients, 'email');
        $names = $this->getRecipientsInfo($event->recipients, 'name');
        $combine = $names->combine($emails);
        $dumpArray = [];

        foreach($combine as $name => $email){
            \Mail::to($email)->queue(new EventReminderEmail($event->event, $name));
        }
        
    }

    public function getRecipientsInfo($rCollection, $info){
        return $rCollection->map(function($r) use ($info) {return is_array([$r][0]) ? [$r][0][$info] : [$r][0]->map(function($ae) use ($info){return [$ae][0][$info];});})->flatten()->filter(function($recipient){return $recipient != null;});
    }
}
