<?php

namespace App\Listeners\YouTube;

use App\Events\YouTube\YoutubeVideoAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mail\SendYoutubeEmail;

class SendYoutubeEmailEvent
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
        // dd(['project' => $event->project, 'youtube' => $event->youtube]);
        $candidates = $this->emailCandidates($event->project, $event->youtube);
        foreach ($candidates as $candidate) {
            \Mail::to($candidate)->queue(new SendYoutubeEmail($event->project, $event->youtube));
        }

    }

    public function emailCandidates($project, $youtube){
        
        $aes = $project->client->aes->map(function($ae){return $ae->email;});
        $youtubeArray = explode(',', $youtube->email_list);

        $emailArray = [
            'kmoore@brproud.com',
            $project->client->primary_contact_email,
            $project->client->agency ? $project->client->agency->contact_email : null,
            $aes
        ];

        foreach ($youtubeArray as $value) {
            $emailArray[] = $value;
        }

        return collect($emailArray)->filter(function($email){return $email != '' || $email != null;})->flatten();
    }
}
