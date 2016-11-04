<?php

namespace App\Listeners\Project;

use App\Events\Project\LogActivity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Plog;

class ProgressEventOccured
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
        if($event->table == 'progress'){
            switch ($event->event) {
                case 'updated':
                    $this->plog->create(['project_id' => $event->object->id, 'log' => 'PROGRESS:UPDATED:'.$event->object->progress->id.':'.$event->list]);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}
