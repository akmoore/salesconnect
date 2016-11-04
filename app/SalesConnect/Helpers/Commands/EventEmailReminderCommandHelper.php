<?php

namespace App\SalesConnect\Helpers\Commands;

use App\Calendar;
use Carbon\Carbon;
use App\Events\EmailCalendarEventOneDayOut;
use App\Mail\EventReminderEmail;

class EventEmailReminderCommandHelper {

	public $event;

	public function __construct(Calendar $event){
		$this->event = $event;
	}

	public function emailReminder(){
		// dd('Email Reminder');
		$now = Carbon::now('America/Chicago');
		$events = $this->event->with('project', 'project.client.aes', 'project.client.agency')
									   ->whereEmailed(0)
									   ->whereEmailedAt(null)
									   ->get()
									   ->filter(function($event) use ($now){
									   		// $ed = $event->event_date->timezone('America/Chicago');

									   		// $edDiff = \Carbon::parse($event->start_date_timestamp)->diffInDays($now);
									   		// return $edDiff > 2;
									   		return Carbon::parse($event->start_date_timestamp) > $now;
									   })
									   ->filter(function($event) use ($now){
									   		$edDiff = Carbon::parse($event->start_date_timestamp)->diffInDays($now);
									   		return $edDiff >= 3 && $edDiff <= 4;
									   });
		// dd($events);

		foreach ($events as $event) {
			$recipients = [
				'editor' => [
					'name' => 'Ken',
					'email' => 'ak_moore@live.com'
				],
				'client' => [
					'name' => $event->project->client->primary_contact_first_name,
					'email' => $event->project->client->primary_contact_email
				],
				'aes' => $event->project->client->aes->map(function($ae){
							return [
								'name' => $ae->first_name,
								'email' => $ae->email,
							];
						 }),
				'agency' => [
					'name' => $event->project->client->agency ? $event->project->client->agency->contact_first_name : null,
					'email' => $event->project->client->agency ? $event->project->client->agency->contact_email : null
				]
				
			];


			
			$rCollection = collect($recipients)->filter(function($email){return $email != null;});

			event(new EmailCalendarEventOneDayOut($event, $rCollection));
		}

	}
}