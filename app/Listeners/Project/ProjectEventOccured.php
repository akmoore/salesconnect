<?php

namespace App\Listeners\Project;

use App\Events\Project\LogActivity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Plog;
use App\Project;

class ProjectEventOccured
{
    public $plog;
    public $project;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Plog $plog, Project $project)
    {
        $this->plog = $plog;
        $this->project = $project;
    }

    /**
     * Handle the event.
     *
     * @param  LogActivity  $event
     * @return void
     */
    public function handle(LogActivity $event)
    {
        if($event->table == 'project'){
            switch ($event->event) {
                case 'created':
                    $this->plog->create(['project_id' => $event->object->id, 'log' => 'PROJECT:CREATED']);
                    break;
                case 'updated':
                    $list = $event->list;
                    $this->plog->create(['project_id' => $event->object->id, 'log' => 'PROJECT:UPDATED:'.$list]);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}
