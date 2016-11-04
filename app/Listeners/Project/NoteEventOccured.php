<?php

namespace App\Listeners\Project;

use App\Events\Project\LogActivity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Plog;

class NoteEventOccured
{
    protected $plog;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Plog $plog)
    {
        $this->plog = $plog;
    }

    /**
     * Handle the event.
     *
     * @param  LogActivity  $event
     * @return void
     */
    public function handle(LogActivity $event)
    {
        if($event->table == 'notes'){
            switch ($event->event) {
                case 'created':
                    $this->plog->create([
                        'project_id' => $event->object->project_id, 
                        'log' => 'NOTE:CREATED:'.studly_case($event->object->title)
                    ]);
                    break;
                case 'updated':
                    $this->plog->create([
                        'project_id' => $event->object->project_id, 
                        'log' => 'NOTE:UPDATED:'.studly_case($event->object->title).':'.$event->list
                    ]);
                    break;
                case 'deleted':
                    $this->plog->create([
                        'project_id' => $event->object->project_id, 
                        'log' => 'NOTE:DELETED:'.studly_case($event->object->title)
                    ]);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}
