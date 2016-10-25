<?php

namespace App\SalesConnect\Helpers;

trait OrderHelperTrait {
	
	public function poFields($proj, $ord){
		setlocale(LC_MONETARY, 'en_US.UTF-8');
		return $array = [
			'title' => $proj->title,
			'year' => $proj->created_at->format('Y'),
			'agency' => $this->getAgency($proj),
			'advertiser' => $proj->client->company_name,
			'salesperson' => $this->getSalesperson($proj),
			'date_of_order' => $proj->start_date->format('M d, Y'),
			'date_completed' => $this->getDateCompleted($proj),
			'editor' => $this->getEditor($ord),
			'client_info' => [
				'street' => $proj->client->street,
				'city' => $proj->client->city,
				'state' => $proj->client->state,
				'postal' => $proj->client->postal,
				'poc' => $proj->client->contact_full_name,
				'poc_phone' => $proj->client->primary_contact_phone,
				'poc_email' => $proj->client->primary_contact_email
			],
			'internal_data' => [
				'manager' => $this->getManager($proj),
				'production_free' => $proj->production_free ? 'Yes' : 'No',
				'promotional' => $proj->production_promotional ? 'Yes' : 'No',
				'produced_by' => $proj->air_date->format('M d, Y')
			],
			'description' => $this->getDescription($proj),
			'table' => [
				'editing' => $this->getEditingInfo($proj),
				'location' => $this->getLocationInfo($proj),
				'dvd' => [
					'date' => $ord->dvd_date ? $ord->dvd_date->format('m/d/Y') : null,
					'count' => $ord->dvd,
					'total_charge' => $ord->dvd * 25,
					'display_total_charge' => money_format('%n', $ord->dvd * 25)
				],
				'crawl' => [
					'date' => $ord->crawl_date ? $ord->crawl_date->format('m/d/Y') : null,
					'count' => $ord->crawl,
					'total_charge' => $ord->crawl * 50,
					'display_total_charge' => money_format('%n', $ord->crawl * 50)
				],
				'green_screen' => $this->getGreenScreenInfo($proj),
				'music_library' => [
					'date' => $ord->music_library_date ? $ord->music_library_date->format('m/d/Y') : null,
					'count' => $ord->music_library,
					'total_charge' => $ord->music_library * 25,
					'display_total_charge' => money_format('%n', $ord->music_library * 25)
				],
				'total_work_amount' => $this->getTotalWorkAmount($proj, $ord),
				'display_total_work_amount' => money_format('%n', $this->getTotalWorkAmount($proj, $ord))
			]
		];
	}

	private function getAgency($proj){
		return $proj->client->agency ? $proj->client->agency->agency_name : 'N/A';
	}

	private function getSalesperson($proj){
		$returnArray = [];
		$aes = $proj->client->aes->map(function($ae){return $ae->full_name;});
		foreach ($aes as $key => $ae) {
			if($key == $aes->count() - 1){
				$returnArray[] = $ae;
			}else{
				$returnArray[] = $ae . ', ';
			}
		}
		return $returnArray;
	}

	private function getDateCompleted($proj){
		return $proj->end_date ? $proj->end_date->format('M d, Y') : 'Not Completed';
	}

	private function getEditor($ord){
		return $ord->editor == 'ken' ? 'Ken Moore' : 'Vincent Lagattuta';
	}

	private function getManager($proj){
		$returnArray = [];
		$managers = $proj->client->aes->map(function($ae){return $ae->manager;})->map(function($manager){return $manager->full_name;});
		foreach ($managers as $key => $manager) {
			if($key == $managers->count() - 1){
				$returnArray[] = $manager;
			}else{
				$returnArray[] = $manager . ', ';
			}
		}
		return $returnArray;
	}

	private function getDescription($proj){
		$note = $proj->notes->filter(function($note){return $note->primary == 1;})->pluck('comments');
		return $note[0];
	}

	private function getEditingInfo($proj){
		if($proj->events){
			if($proj->events->filter(function($event){return $event->event_type == 'edit';})->count()){
				$edit = $proj->events->filter(function($event){return $event->event_type == 'edit';});
				return $this->getMetaInfo($edit);
			}
		}
		return $this->returnAllNull();;
	}

	private function getLocationInfo($proj){
		if($proj->events){
			$location = $proj->events->filter(function($event){return $event->event_type == 'shoot' && $event->location != 'green-screen';});
			if($location->count()){
				return $this->getMetaInfo($location);
			}
		}
		return $this->returnAllNull();;
	}

	private function getGreenScreenInfo($proj){
		if($proj->events){
			$greenScreen = $proj->events->filter(function($event){return $event->event_type == 'shoot' && $event->location == 'green-screen';});
			if($greenScreen->count()){
				return $this->getMetaInfo($greenScreen);
			}
		}
		return $this->returnAllNull();
	}

	private function getTotalWorkAmount($proj, $ord){
		return collect([
			$this->getEditingInfo($proj)['total_charge'],
			$this->getLocationInfo($proj)['total_charge'],
			$ord->dvd * 25,
			$ord->crawl * 50,
			$this->getGreenScreenInfo($proj)['total_charge'],
			$ord->music_library * 25
		])->sum();
	}

	private function getMetaInfo($item){
		$date = $item->sortBy('event_date')->last()->event_date->format('m/d/Y');
		$duration = $item->map(function($e){return $e->duration_hours;})->reduce(function($first, $next){return $first + $next;});
		$total_charge = $duration * 150;
		$display_total_charge = money_format('%n', $total_charge);
		return [
			'date' => $date,
			'duration' => $duration,
			'total_charge' => $total_charge,
			'display_total_charge' => $display_total_charge
		];
	}	

	private function returnAllNull(){
		return [
			'date' => null,
			'duration' => 0,
			'total_charge' => 0,
			'display_total_charge' => '$0.00'
		];
	}
}














