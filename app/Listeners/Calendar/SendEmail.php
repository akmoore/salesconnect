<?php

namespace App\Listeners\Calendar;

use App\Events\CalendarEventCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mail\EventWasCreatedMail;

class SendEmail
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
     * @param  CalendarEventCreated  $event
     * @return void
     */
    public function handle(CalendarEventCreated $event)
    {
        // dd($event->event->event_type);
        switch ($event->event->event_type) {
            case 'prepro':
            case 'shoot':
                $emails = $this->getEmails($event->project);
                foreach($emails as $email){
                    \Mail::to($email)->queue(new EventWasCreatedMail($event->event, $event->project));
                }
                break;
            
            default:
                # code...
                break;
        }
    }

    public function getEmails($project){
        $emailsArray = [
            'ak_moore@live.com',
            $project->client->primary_contact_email,
            $project->client->aes->map(function($ae){return $ae->email;}),
            $project->client->agency ? $project->client->agency->contact_email : ''
        ];
        return $emails = collect($emailsArray)->flatten()->filter(function($email){return $email != '';});
    }
}
