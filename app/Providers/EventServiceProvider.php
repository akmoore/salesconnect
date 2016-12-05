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
            'App\Listeners\Calendar\SendEmail',
            'App\Listeners\Calendar\UpdateOrderTotal'
        ],
        'App\Events\CalendarEventDeleted' => [
            'App\Listeners\Calendar\UpdateOrderTotalOnDelete'
        ],
        'App\Events\NoteWasCreatedOrUpdated' => [
            'App\Listeners\Notes\SendNotesEmail'
        ],
        'App\Events\EmailCalendarEventOneDayOut' => [
            'App\Listeners\Calendar\SendOneDayOutEmail',
            'App\Listeners\Calendar\SetEventAsSent'
        ],
        'App\Events\TextCalendarEventOneHourOut' => [
            'App\Listeners\Calendar\SendOneHourOutText',
            'App\Listeners\Calendar\SetTextAsSent'
        ],
        'App\Events\Project\LogActivity' => [
            'App\Listeners\Project\ProjectEventOccured',
            'App\Listeners\Project\CalendarEventOccured',
            'App\Listeners\Project\NoteEventOccured',
            'App\Listeners\Project\ProgressEventOccured'
        ],
        'App\Events\YouTube\YoutubeVideoAdded' => [
            'App\Listeners\YouTube\SendYoutubeEmailEvent',
            'App\Listeners\YouTube\SetISCI'
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
