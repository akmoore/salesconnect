<?php

namespace App\SalesConnect\Helpers;

class FlashMessageHelper {

	public function created($item = null){
		if($item){
			return ['message' => $item . " was successfully created.", 'color' => 'success'];
		}else{
			return ['message' => 'Event has been successfully created.'];
		}
		
	}

	public function updated($item = null){
		if($item){
			return ['message' => $item . ' was successfully updated.', 'color' => 'success'];
		}else{
			return ['message' => 'Event has been successfully updated.'];
		}
		
	}

	public function deleted($item = null){
		if($item){
			return ['message' => $item . ' was successfully deleted.'];
		}else{
			return ['message' => 'Event has been successfully deleted.'];
		}
		
	}

	public function event_error(){
		return ['message' => 'Scheduling conflict. Check date and times.'];
	}

}