<?php

namespace App\SalesConnect\Helpers\Repositories;

use App\Note;
use App\Project;
use App\Events\NoteWasCreatedOrUpdated;
use App\SalesConnect\Helpers\Interfaces\NoteInterface;

class NoteRepo implements NoteInterface{

	protected $note;
	protected $project;

	public function __construct(Note $note, Project $project){
		$this->note = $note;
		$this->project = $project;
	}

	public function showAll(){
		//return all records
	}

	public function showRecord($id){
		return $this->note->findOrFail($id);
	}

	public function createRecord($request){
		$project = $this->getProject($request['project_id']);
		$note = $this->note->create([
			'project_id' => $request['project_id'],
			'title' => $request['title'],
			'primary' => $request['primary'],
			'emailable' => $request['emailable'],
			'comments' => $request['comments'],
			'recipients' => $request['recipients'],
			'has_been_emailed' => 0
		]);

		//Run Event if Emailable is true
		event(new NoteWasCreatedOrUpdated($note, $project));

		return $note;
	}

	public function updateRecord($request, $id){
		$project = $this->getProject($request['project_id']);
		$note = $this->note->findOrFail($id);
		$note->update([
			'project_id' => $request['project_id'],
			'title' => $request['title'],
			'primary' => $request['primary'],
			'emailable' => $request['emailable'],
			'comments' => $request['comments'],
			'recipients' => $request['recipients'],
			'has_been_emailed' => $note->has_been_emailed ? 1 : 0
		]);

		// if($request['emailable'] === '1'){
		// 	return "Run an event to run a chronjob to email this note out";
		// }

		event(new NoteWasCreatedOrUpdated($note, $project));

		return $note;
	}

	public function deleteRecord($id){
		// $project = $this->project->find($id);
		// $project->delete();

		// return $project;

		$note = $this->note->find($id);
		$note->delete();

		return $note;

	}	

	public function getProject($id){
		if(is_numeric($id)){
			return $this->project->with('client', 'client.aes', 'client.agency')->findOrFail($id);
		}else{
			return $this->project->with('client')->whereSlug($id)->firstOrFail();
		}
	}
}