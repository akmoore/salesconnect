<?php

namespace App\SalesConnect\Helpers\Repositories;

use App\Agency;
use App\SalesConnect\Helpers\Interfaces\AgencyInterface;

class AgencyRepo implements AgencyInterface{

	protected $agency;

	public function __construct(Agency $agency){
		$this->agency = $agency;
	}

	public function showAll(){
		return $this->agency->with('clients')->get()->sortBy('agency_name');
	}

	public function showRecord($id){
		return $agency = $this->agency->with('clients')->whereSlug($id)->firstOrFail();
	}

	public function createRecord($request){
		$agency = $this->agency->create([
			'agency_name' => $request['agency_name'],
			'contact_first_name' => $request['contact_first_name'],
			'contact_last_name' => $request['contact_last_name'],
			'contact_email' => $request['contact_email'],
			'contact_phone' => $request['contact_phone']
		]);

		return $agency;
	}

	public function updateRecord($request, $id){
		$agency = $this->showRecord($id);

		$agency->update([
			'agency_name' => $request['agency_name'],
			'contact_first_name' => $request['contact_first_name'],
			'contact_last_name' => $request['contact_last_name'],
			'contact_email' => $request['contact_email'],
			'contact_phone' => $request['contact_phone']
		]);

		return $agency;
	}

	public function deleteRecord($id){
		$agency = $this->agency->find($id);

		if($agency->clients->count()) return false;

		$agency->delete();

		return $agency;
	}	
}