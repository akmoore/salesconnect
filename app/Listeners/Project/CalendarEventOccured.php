<?php

namespace App\Listeners\Project;

use App\Events\Project\LogActivity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\PLog;

class CalendarEventOccured
{
    protected $plog;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PLog $plog)
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
        if($event->table == 'calendars'){
            switch ($event->event) {
                case 'created':
                    $this->plog->create(['project_id' => $event->object->project_id, 'log' => 'EVENT:CREATED:'.$event->object->id]);
                    break;
                case 'updated':
                    $this->plog->create(['project_id' => $event->object->project_id, 'log' => 'EVENT:UPDATED:'.$event->object->id.':'.$event->list]);
                    break;
                case 'deleted':
                    $this->plog->create(['project_id' => $event->object->project_id, 'log' => 'EVENT:DELETED:'.$event->object->id]);
                    break;
                
                default:
                    break;
            }
        }
    }
}
