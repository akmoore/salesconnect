<?php

namespace App\Listeners\Notes;

use App\Mail\NoteWasCreatedOrUpdatedMail;
use App\Events\NoteWasCreatedOrUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotesEmail
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
     * @param  NoteWasCreatedOrUpdated  $event
     * @return void
     */
    public function handle(NoteWasCreatedOrUpdated $event)
    {
        //Send the Note's email to all appropriate recipients
        if($event->note->emailable){
            $emails = $this->createEmailableArray($event->project, $event->note->recipients);
            foreach($emails as $email){
                \Mail::to($email)->queue(new NoteWasCreatedOrUpdatedMail($event->note, $event->project));
            }
        }

        $event->note->emailable = 0;
        $event->note->save();
    }

    public function createEmailableArray($project, $recipients){
        $repArray = explode(',', $recipients);
        $filteredRepArray = $this->collectRepArray($repArray);
        $assocEmail = $this->collectAssocArray($project);
        return $emailableArray = $filteredRepArray->merge($assocEmail)->unique()->values()->all();
    }

    private function collectRepArray($array){
        return collect($array)->filter(function($rep){return filter_var($rep, FILTER_VALIDATE_EMAIL)? $rep : null;});
    }

    private function collectAssocArray($project){
        
        $associatesArray = [
            'ak_moore@live.com',
            $project->client->primary_contact_email,
            $project->client->aes->map(function($ae){return $ae->email;}),
            $project->client->agency ? $project->client->agency->contact_email : ''
        ];
        return collect($associatesArray)->flatten()->filter(function($email){return $email != '';});
    }
}






