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
                    \Mail::to($email['email'])->queue(new EventWasCreatedMail($event->event, $event->project, $email));
                }
                break;
            
            default:
                # code...
                break;
        }
    }

    public function getEmails($project){

        $editor = ['name' => 'Ken Moore', 'email' => 'kmoore@brproud.com'];
        $client = ['name' => $project->client->primary_contact_first_name, 'email' => $project->client->primary_contact_email];
        $aes = $project->client->aes->map(function($ae){return ['name' => $ae->first_name, 'email' => $ae->email];});
        $agency = $project->client->agency ? ['name' => $project->client->agency->contact_first_name, 'email' => $project->client->agency->contact_email] : '';

        $emailsArray = [$editor, $client, $agency];
        foreach ($aes->toArray() as $value) {
            array_push($emailsArray, $value);
        }

        return $emails = collect($emailsArray)->filter(function($email){return $email != '';});
    }


}
