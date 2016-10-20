<?php

namespace App\Listeners;

use App\Progress;
use App\Project;
use App\Events\ProjectWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateProgress
{
    protected $progress;
    protected $project;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Progress $progress, Project $project)
    {
        $this->progress = $progress;
        $this->project = $project;
    }

    /**
     * Handle the event.
     *
     * @param  ProjectWasCreated  $event
     * @return void
     */
    public function handle(ProjectWasCreated $event)
    {
        $progress = $event->project->progress()->save(new \App\Progress());
        // var_dump($event->project);
    }
}
