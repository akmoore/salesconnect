<?php

namespace App\SalesConnect\Helpers\Repositories;


use App\Youtube;
use App\Project;
use App\Events\YouTube\YoutubeVideoAdded;
use App\SalesConnect\Helpers\Interfaces\YoutubeInterface;

class YoutubeRepo implements YoutubeInterface {

	protected $yt;
	protected $project;

	public function __construct(Youtube $yt, Project $project){
		$this->yt = $yt;
		$this->project = $project;
	}
	
	public function showAll(){
		//return all records
	}

	public function showRecord($id){
		//return a single record
	}

	public function createRecord($request){
		//create a single record
		// return $request->all();
		$project = $this->project->find($request['project_id']);
		$isCount = $this->youTubeCount($project);
		$countPlus = $project->videos->count() + 1;
		$youtube = $this->yt->create([
			'project_id' => $request['project_id'],
			'link' => $request['link'],
			'title' => $isCount ? $project->isci.'-'.$countPlus : $project->isci,
			'description' => '',
			'emailed' => 0,
			'email_list' => $request['email_list']
		]);

		event( new YoutubeVideoAdded($youtube, $project));

		return $youtube;

	}

	public function updateRecord($request, $id){
		//update a single record
	}

	public function deleteRecord($id){
		//delete a single record
	}	

	public function youTubeCount($project){
		if($project->videos->count() >= 1) return true;
		return false;
	}
}