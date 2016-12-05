<?php

namespace App\SalesConnect\Helpers\Repositories;

use App\Manager;
use App\SalesConnect\Helpers\Interfaces\ManagerInterface;

class ManagerRepo implements ManagerInterface{
	protected $manager;

	public function __construct(Manager $manager){
		$this->manager = $manager;
	}

	public function showAll(){
		$managers = $this->manager->get();
		return $managers->sortBy('full_name');
	}

	public function showRecord($id){
		$manager = $this->manager->with('aes.clients.projects')->whereSlug($id)->firstOrFail();
		return $manager;
	}

	public function createRecord($request){
		$manager = $this->manager->create([
			'first_name' => $request['first_name'],
			'last_name' => $request['last_name'],
			// 'work_phone' => $this->stripPhoneNumber($request['work_phone']),
			// 'cell_phone' => $this->stripPhoneNumber($request['cell_phone']),
			'work_phone' => $request['work_phone'],
			'cell_phone' => $request['cell_phone'],
			'email' => $request['email'],
			'team' => $request['team']
		]);

		return $manager;
	}

	public function updateRecord($request, $id){
		$manager = $this->manager->whereSlug($id)->firstOrFail();
		$manager->update([
			'first_name' => $request['first_name'],
			'last_name' => $request['last_name'],
			// 'work_phone' => $this->stripPhoneNumber($request['work_phone']),
			// 'cell_phone' => $this->stripPhoneNumber($request['cell_phone']),
			'work_phone' => $request['work_phone'],
			'cell_phone' => $request['cell_phone'],
			'email' => $request['email'],
			'team' => $request['team']
		]);

		return $manager;
	}

	public function deleteRecord($manager){
		$manager->delete();
		return $manager;
	}

	public function getAes($id){
		return $this->showRecord($id)->aes;
	}	

	public function clearedAes($id){
		$manager = $this->manager->findOrFail($id);
		
		return $manager->aes->count() === 0 ? $this->deleteRecord($manager) : false;
	}

	public function stripPhoneNumber($number){
		$nsa = str_split($number); // $nsa => numberStringArray // (225) 288-9870 
		$firstThree = $nsa[1].$nsa[2].$nsa[3];
		$secondThree = $nsa[6].$nsa[7].$nsa[8];
		$lastFour = $nsa[10].$nsa[11].$nsa[12].$nsa[13];
		return $firstThree.$secondThree.$lastFour;
	}
}




