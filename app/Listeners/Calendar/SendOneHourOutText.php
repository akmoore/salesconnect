<?php

namespace App\Listeners\Calendar;

use App\Events\TextCalendarEventOneHourOut;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Twilio\Rest\Client;
use App\Project;

class SendOneHourOutText implements ShouldQueue
{
    protected $client;
    protected $project;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
        $this->project = new Project();
    }

    /**
     * Handle the event.
     *
     * @param  TextCalendarEventOneHourOut  $event
     * @return void
     */
    public function handle(TextCalendarEventOneHourOut $event)
    {
        // dd('Ken');
        // dd($event);
        // return 'done';
        // $event->map(function($evt){
        //     return $this->client->messages->create(
        //         '+12252889870',
        //         [
        //             'from' => config('services.twilio.phone'),
        //             'body' => 'Hey Ken, just seeing if this works... through the event listenter'
        //         ]
        //     );
        // });
        // $count = 1;
        // $eventArray = [];

        // dd($event->phone_numbers[11]);
        // dd($event->phone_numbers[11]['event']['start_date_time']);

        // dd(\Carbon\Carbon::parse($event->event->event_start_time)->format('g:ia'));
        // dd($this->project->find($event->event->project_id));

        // dd($this->project-find($event->event->project_id));
        // dd($event->phone_numbers);
        // dd($event->phone_numbers[11]['phone_numbers']);
        // return "done";
        // ->format('g:i a')
        // $n = 1;
        foreach($event->phone_numbers as $phone_number){
            // $eventArray[] = $phone_number;
            $this->client->messages->create(
                $phone_number,
                [
                    'from' => config('services.twilio.phone'),
                    // 'body' =>  $this->bodyMessage($event->event)
                    'body' => $this->bodyMessage($event->event)
                ]
            );
        }

        // $this->client->messages->create(
        //     '+12252889870',
        //     [
        //         'from' => config('services.twilio.phone'),
        //         'body' => 'Hey Ken, just seeing if this works... through the event listenter - ' . $event->phone_numbers[11]
        //     ]
        // );

        // dd($eventArray);
        // dd('Where is this going?');
        // $recipients = $event->events['recipients']->map(function($rep){return $rep;});
        // dd($recipients);
    }

    public function bodyMessage($event){
        //Reminder: The CLIENT'S NAME preproduction meeting is scheduled today at 5:30am.
        $project = $this->project->with('client')->find($event->project_id);
        $client = $project->client->company_name;
        $type = $event->event_type == 'prepro' ? 'preproduction meeting' : 'shoot';
        $time = \Carbon\Carbon::parse($event->event_start_time)->format('g:ia');
        return 'Reminder: ' . $client . ' ' . $type . ' ' . 'is scheduled today at ' . $time . '.';
    }
}






