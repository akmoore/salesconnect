<?php 

namespace App\SalesConnect\Helpers;

use App\Calendar;

class EventHelper {

	protected $event;

	public function __construct(Calendar $event){
		$this->event = $event;
	}

	public function checkEventConflict (array $eventData){

		if($eventData['event_end_time_submit'] <= $eventData['event_start_time_submit']){
			return true;
		}

		$isConflict = $this->event->where('event_date', '=', $eventData['event_date_submit'])
								  ->where('event_start_time', '<=', $eventData['event_end_time_submit'])
								  ->where('event_end_time', '>=', $eventData['event_start_time_submit'])->get()->toArray();

		return $isConflict ? true : false;
	}

	public function checkEventConflictOnUpdate (array $eventData){

		// return $eventData['id'];

		$isConflict = $this->event->where('id', '!=', $eventData['id'])
								  ->where('event_date', '=', $eventData['event_date_submit'])
								  ->where('event_start_time', '<=', $eventData['event_end_time_submit'])
								  ->where('event_end_time', '>=', $eventData['event_start_time_submit'])->get()->toArray();

		return $isConflict ? 'true' : 'false';
	}
}











