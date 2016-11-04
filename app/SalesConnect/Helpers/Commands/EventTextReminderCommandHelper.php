<?php

namespace App\SalesConnect\Helpers\Commands;

use Carbon\Carbon;
use App\Calendar;
use App\Events\TextCalendarEventOneHourOut;

class EventTextReminderCommandHelper {

	protected $events;

	public function __construct(Calendar $events){
		$this->events = $events;
	}

	public function text(){
		// dd('text the reminder');
		$now = Carbon::now('America/Chicago');
		// dd($now);
		// dd($this->events->all());

		$phone_numbers = $this->events->with('project.client.aes', 'project.client.agency')->get()
							   ->filter(function($event) use ($now){
							   		// Find the event where the type is not edit and the start date and time is
							   		// greater than the current date and time.
									return $event->event_type != 'edit' && \Carbon\Carbon::parse($event->start_date_timestamp) > $now;
								})
							   ->filter(function($event) use ($now){
							   		// Return the event that is one hour of less than the current time
							   		return $now->diffInHours(Carbon::parse($event->start_date_timestamp)) <= 1;
							   })->map(function($event){
							   		//Queue up an event listener to send a text message for each calendar event.
							   		$phone_numbers = collect($recepients = [
							   			'+12252889870', //Me
							   			$event->project->client->primary_contact_phone_callable, //Client
							   			$event->project->client->aes->map(function($ae){return $ae->cell_phone_callable;}), // Ae
							   			$event->project->client->agency ? $event->project->client->agency->contact_phone_callable : null
							   		])->filter(function($rep){return $rep != null;})->flatten();
							   		 // ['event' => $event, 'phone_numbers' => $rep];
							   		// dd($event);
							   		// dd($phone_numbers);
							   		// dd('Hello');
							   		// return $rep;
							   		event(new TextCalendarEventOneHourOut($event, $phone_numbers));
							   });
		// dd($phone_numbers[12]);
		// return $events;
		
	}
}

// return $events->map(function($event) use ($now){return [$event['start_timestamp'], $now->diffInHours(\Carbon\Carbon::parse($event['start_timestamp']))];})->filter(function($event) use ($now){return \Carbon\Carbon::parse($event[0]) > $now;});