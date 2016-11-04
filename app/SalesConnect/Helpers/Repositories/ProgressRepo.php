<?php

namespace App\SalesConnect\Helpers\Repositories;

use App\Progress;
use App\Project;
use App\Events\Project\LogActivity;
use App\SalesConnect\Helpers\ExtractedListTrait;
use App\SalesConnect\Helpers\Interfaces\ProgressInterface;

class ProgressRepo implements ProgressInterface{

	use ExtractedListTrait;

	protected $progress;
	protected $project;

	public function __construct(Progress $progress, Project $project){
		$this->progress = $progress;
		$this->project = $project;
	}

	public function showAll(){
		//return all records
	}

	public function showRecord($id){
		return $this->progress->findOrFail($id);
	}

	public function createRecord($request){
		//create a single record
	}

	public function updateRecord($request, $data){
		
		$preSum = $this->preSum($request);

		$project = $this->project->whereSlug($data[0])->first();
		$progOrg = $this->extractOriginal($project->progress);
		$project->progress()->update([
			'project_id' => $request['project_id'],
			'prepro_schedule' => $request['prepro_schedule'] ? 1 : 0,
			'shoot_schedule' => $request['shoot_schedule'] ? 1 : 0,
			'initial_edit_done' => $request['initial_edit_done'] ? 1 : 0,
			'first_revision' => $request['first_revision'] ? 1 : 0,
			'client_final_approval' => $request['client_final_approval'] ? 1 : 0,
			'received_po' => $request['received_po'] ? 1 : 0,
			'upload_master_control' => $request['upload_master_control'] ? 1 : 0,
			'upload_youtube' => $request['upload_youtube'] ? 1 : 0,
			'archived' => $request['archived'] ? 1 : 0,
			'aired' => $request['aired'] ? 1 : 0,
			'sum' => $preSum * 10
		]);
		// $progress = (new \App\Progress())->where('project_id', '=', $project->id);
		// dd($progOrg);
		// dd([$progOrg, $request->all()]);
		$list = $this->extractOriginalValues($progOrg, $request->all());
		event(new LogActivity('progress', 'updated', $project, $list));

		if($project->sum >= 100) {
			//Run an event
		}

		return $project;

	}

	public function deleteRecord($id){
		//delete a single record
	}	

	protected function preSum($request){
		return collect($request->all())->filter(function($item, $key){ 
				return $key !== 'project_id';
			   })->reduce(function ($carry, $item) {
				return $carry + $item;
			   });
	}
}
