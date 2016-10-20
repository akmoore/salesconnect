<?php

namespace App\SalesConnect\Helpers\Repositories;

use App\Ae;
use App\Manager;
use App\SalesConnect\Helpers\Interfaces\AeInterface;

class AeRepo implements AeInterface {
	
	protected $ae;
	protected $managers;

	public function __construct(Ae $ae, Manager $managers){
		$this->ae = $ae;
		$this->managers = $managers;
	}

	public function showAll(){
		$aes = $this->ae->get();
		return $aes->sortBy('full_name');
		// return $aes->pluck('full_name', 'id');
	}

	public function showRecord($id){
		// return 'a single record';
		return $this->ae->with('manager', 'clients.projects')->whereSlug($id)->firstOrFail();
	}

	public function createRecord($request){
		// return 'create a single record';
		// return $request->all();
		return $this->ae->create([
			'manager_id' 	=> $request['manager_id'],
			'first_name' 	=> $request['first_name'],
			'last_name' 	=> $request['last_name'],
			'work_phone' 	=> $request['work_phone'],
			'cell_phone' 	=> $request['cell_phone'],
			'email' 		=> $request['email']
		]);
	}

	public function updateRecord($request, $id){
		// return 'update a single record';
		// $ae = $this->ae->whereSlug($id)->firstOrFail();
		$ae = $this->showRecord($id);

		if($ae){
			$ae->update([
				'manager_id' 	=> $request['manager_id'],
				'first_name' 	=> $request['first_name'],
				'last_name' 	=> $request['last_name'],
				'work_phone' 	=> $request['work_phone'],
				'cell_phone' 	=> $request['cell_phone'],
				'email' 		=> $request['email']
			]);
		}

		return $ae;
	}

	public function deleteRecord($id){
		// return 'delete a single record';
		$ae = $this->ae->findOrFail($id);
		$ae->delete();

		return $ae->full_name . " record has been deleted";
	}

	public function getManagers(){
		return $this->managers->get()->sortBy('first_name')->pluck('full_name', 'id');
	}	

	public function getProjects($id){
		return $ae = $this->showRecord($id);
	}

}









