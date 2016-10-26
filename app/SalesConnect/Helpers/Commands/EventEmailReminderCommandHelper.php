<?php

namespace App\SalesConnect\Helpers\Commands;

use App\Calendar;
use Carbon\Carbon;
use App\Events\EmailCalendarEventOneDayOut;
use App\Mail\EventReminderEmail;

class EventEmailReminderCommandHelper {

	public $event;

	public function emailReminder(){
		$now = Carbon::now('America/Chicago');
		$events = (new \App\Calendar())->with('project', 'project.client.aes', 'project.client.agency')
									   ->whereEmailed(0)
									   ->whereEmailedAt(null)
									   ->get()
									   ->filter(function($event) use ($now){
									   		$ed = $event->event_date->timezone('America/Chicago');
									   		$edDiff = $ed->diffInHours($now);
									   		return $edDiff >= 30 && $edDiff <= 41;
									   });

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