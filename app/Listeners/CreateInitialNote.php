<?php

namespace App\Listeners;

use App\Note;
use App\Events\ProjectWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateInitialNote
{
    public $note;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Handle the event.
     *
     * @param  ProjectWasCreated  $event
     * @return void
     */
    public function handle(ProjectWasCreated $event)
    {
        // $t = preg_match('/{%.+%}/', $event->request['notes'], $title);
        // if($t){
        //     $title = chop(substr($title[0], 2), '%}');
        // }
        // $newComments = preg_replace('/{%.+%}/', '', $event->request['notes']);
        $t = preg_match('/{%.+%}/', $event->request['notes'], $title);
        if($t) $title = chop(substr($title[0], 2), '%}');
        $newComments = preg_replace('/{%.+%}/', '', $event->request['notes']); 

        if(!empty(trim($event->request['notes']))){
            $this->note->create([
                'project_id' => $event->project->id,
                'primary' => 1,
                'title' => is_array($title)? 'Description': $title,
                'comments' => is_string($title) ? $newComments : $event->request['notes'],
                'emailable' => 0,
                'has_been_emailed' => 0,
                'recipients' => ''
            ]);
        }


    }
}
