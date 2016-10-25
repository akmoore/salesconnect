<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ProjectWasCreated' => [
            'App\Listeners\CreateInitialNote',
            'App\Listeners\CreateProgress',
            'App\Listeners\CreateInitialOrder'
        ],
        'App\Events\OrderWasUpdated' => [
            'App\Listeners\Orders\UpdateDates'
        ],
        'App\Events\CalendarEventCreated' => [
            'App\Listeners\Calendar\SendEmail'
        ],
        'App\Events\NoteWasCreatedOrUpdated' => [
            'App\Listeners\Notes\SendNotesEmail'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
