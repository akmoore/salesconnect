<?php

namespace App\SalesConnect\Helpers\Repositories;

use Carbon\Carbon;
use App\Calendar;
use App\Project;
use App\SalesConnect\Helpers\EventHelperTrait;
use App\SalesConnect\Helpers\Interfaces\CalendarInterface;


class CalendarRepo implements CalendarInterface{

	use EventHelperTrait;

	protected $event;
	protected $project;

	public function __construct(Calendar $event, Project $project){
		$this->event = $event;
		$this->project = $project;
	}

	public function showAll(){
		//return all records
	}

	public function showRecord($id){
		return $this->event->with('project')->findOrFail($id);
	}

	public function createRecord($request){
		$eventData = $this->convertedEventData($request);
		$duration = $this->timeDuration($eventData);
		if($this->checkEventConflict($eventData)) return false;

		$event = $this->event->create([
			'project_id' => $request['project_id'],
			'event_date' => $eventData['event_date'],
			'event_start_time' => $eventData['event_start_time'],
			'event_end_time' => $eventData['event_end_time'],
			'event_type' => $request['event_type'],
			'location' => $request['location'],
			'address' => $request['address'],
			'duration_minutes' => $duration['minutes'],
			'duration_hours' => $duration['hours'],
			'notes' => $request['notes']
		]);	

		return $event;
	}

	public function updateRecord($request, $id){
		// return $id;
		$event = $this->event->find($id);
		$eventData = $this->convertedEventData($request);
		$duration = $this->timeDuration($eventData);
		if($this->checkEventConflictOnUpdate($eventData, $id)) return false;

		// return [$request->all(), $eventData, $duration];
		$event->update([
			'project_id' => $request['project_id'],
			'event_date' => $eventData['event_date'],
			'event_start_time' => $eventData['event_start_time'],
			'event_end_time' => $eventData['event_end_time'],
			'event_type' => $request['event_type'],
			'location' => $request['location'],
			'address' => $request['address'],
			'duration_minutes' => $duration['minutes'],
			'duration_hours' => $duration['hours'],
			'notes' => $request['notes']
		]);

		return $event;
	}

	public function deleteRecord($id){
		$event = $this->event->find($id);
		$event->delete();

		return $event;
	}

	public function getProject($id){
		return $this->project->whereSlug($id)->firstOrFail();
	}

	//Internal Methods to Work with Dates and Times
	public function convertedEventData($request){
		return [
			'event_date' => date($request['event_date']),
			'event_start_time' => date('H:i:s', strtotime($request['event_start_time'])),
			'event_end_time' => date('H:i:s', strtotime($request['event_end_time']))
		];
	}

	public function timeDuration($eventData){
		$startTimeArray = explode(':', $eventData['event_start_time']);
		$startTime = Carbon::createFromTime($startTimeArray[0], $startTimeArray[1], $startTimeArray[2]);
		$endTimeArray = explode(':', $eventData['event_end_time']);
		$endTime = Carbon::createFromTime($endTimeArray[0], $endTimeArray[1], $endTimeArray[2]);
		return [
			'minutes' => $startTime->diffInMinutes($endTime),
			'hours' => round($startTime->diffInMinutes($endTime) / 60, 1, PHP_ROUND_HALF_DOWN)
		];
	}
}