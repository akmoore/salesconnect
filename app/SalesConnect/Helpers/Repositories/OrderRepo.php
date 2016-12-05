<?php

namespace App\SalesConnect\Helpers\Repositories;

use App\Project;
use App\Order;
use App\Events\OrderWasUpdated;
use App\SalesConnect\Helpers\Interfaces\OrderInterface;

use Vsmoraes\Pdf\Pdf;
use App\SalesConnect\Helpers\OrderHelperTrait;

class OrderRepo implements OrderInterface{

	use OrderHelperTrait;

	public $order;
	public $project;
	protected $pdf;

	public function __construct(Order $order, Project $project, Pdf $pdf){
		$this->order = $order;
		$this->project = $project;
		$this->pdf = $pdf;
	}

	public function showAll(){
		//return all records
	}

	public function showRecord($id){
		return $this->order->findOrFail($id);
	}

	public function createRecord($request){
		//create a single record
	}

	public function updateRecord($request, $id){
		$oldOrder = $this->showRecord($id);
		$order = $this->showRecord($id);
		$project = $this->project->with('events')->whereId($request->project_id)->first();
		$orderTotal = $this->getTotalWorkAmount($project, $request);

		$order->update([
			'project_id' => $request['project_id'],
			'stations' => $request['stations'],
			'editor' => $request['editor'],
			'produced_by' => $request['produced_by'],
			'vcd_vhs' => $request['vcd_vhs'],
			'dvd' => $request['dvd'],
			'beta_dub' => $request['beta_dub'],
			'crawl' => $request['crawl'],
			'ftp' => $request['ftp'],
			'music_library' => $request['music_library'],
			'discount' => $request['discount'],
			'order_total' => $orderTotal
		]);

		event(new OrderWasUpdated($oldOrder, $request->all()));
		

		return $order;
	}

	public function deleteRecord($id){
		//delete a single record
	}	

	public function getProject($proj){
		return $project = $this->project->whereSlug($proj)->firstOrFail();
	}

	public function getPdfInfo($project, $order){
		$proj = $this->project->with('client.aes.manager', 'client.agency', 'notes', 'events')->whereSlug($project)->first();
		$ord = $this->showRecord($order);

		return $this->poFields($proj, $ord);
		// return ['project' => $proj, 'order' => $ord];
	}


}