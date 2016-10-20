<?php 

namespace App\SalesConnect\Helpers;

use App\Calendar;

trait EventHelperTrait {

	protected $event;

	public function __construct(Calendar $event){
		$this->event = $event;
	}

	public function checkEventConflict (array $eventData){

		if($eventData['event_end_time'] <= $eventData['event_start_time']){
			return true;
		}

		$isConflict = $this->event->where('event_date', '=', $eventData['event_date'])
								  ->where('event_start_time', '<=', $eventData['event_end_time'])
								  ->where('event_end_time', '>=', $eventData['event_start_time'])->get()->toArray();

		return $isConflict ? true : false;
	}

	public function checkEventConflictOnUpdate (array $eventData, $id){

		// return $eventData['id'];

		$isConflict = $this->event->where('id', '!=', $id)
								  ->where('event_date', '=', $eventData['event_date'])
								  ->where('event_start_time', '<=', $eventData['event_end_time'])
								  ->where('event_end_time', '>=', $eventData['event_start_time'])->get()->toArray();

		return $isConflict ? true : false;
	}
}











