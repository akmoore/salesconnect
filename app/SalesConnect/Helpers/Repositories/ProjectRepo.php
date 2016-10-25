<?php

namespace App\SalesConnect\Helpers\Repositories;

use Storage;
use App\Project;
use App\Note;
use Carbon\Carbon;
use App\Events\ProjectWasCreated;
use App\SalesConnect\Helpers\Interfaces\ProjectInterface;

class ProjectRepo implements ProjectInterface{

	protected $project;
	protected $note;

	public function __construct(Project $project, Note $note){
		$this->project = $project;
		$this->note = $note;
	}

	public function showAll(){
		return $this->project->with('client.aes.manager')->get()->sortBy('title');
	}

	public function showRecord($id){
		return $this->project->with('client.aes.manager', 'notes', 'progress')->whereSlug($id)->firstOrFail();
	}

	public function createRecord($request){
		// preg_match('/{%\(t\).+%}/', $request['notes'], $title);
		// $title = chop(substr($title[0], 5), '%}');
		// return [$title];

		// $t = preg_match('/{%.+%}/', $request['notes'], $title);
		// if($t){
		//     $title = chop(substr($title[0], 2), '%}');
		// }
		// return is_array($title)? '': $title;

		// $newComments = preg_replace('/{%.+%}/', '', $event->request['notes']);

		$pd = $this->produceDate($request['air_date']);
		$project = $this->project->create([
			'client_id' => $request['client_id'],
			'title' => $request['title'],
			'active' => 1,
			'new_client' => $request['new_client'],
			'start_date' => Carbon::now('America/Chicago'),
			'length' => $request['length'],
			'production_free' => $request['production_free'],
			'production_promotional' => $request['production_promotional'],
			'air_date' => Carbon::createFromDate($pd[2], $pd[0], $pd[1], 'America/Chicago'),
		]);



		//Create note for project.
		event(new ProjectWasCreated($request, $project));

		return $project;
	}

	public function updateRecord($request, $id){
		$project = $this->showRecord($id);
		$pd = $this->produceDate($request['air_date']);
		$project->update([
			'client_id' => $request['client_id'],
			'title' => $request['title'],
			'new_client' => $request['new_client'],
			'length' => $request['length'],
			'production_free' => $request['production_free'],
			'production_promotional' => $request['production_promotional'],
			// 'air_date' => Carbon::createFromFormat('Y-m-d', (string)$pd[2].'-'.(string)$pd[0].'-'.(string)$pd[1], 'America/Chicago'),
			// 'air_date' => $request['air_date'],
			'air_date' => (string)$pd[2].'-'.(string)$pd[0].'-'.(string)$pd[1],
			'end_date' => null,
			'c_number' => $request['c_number'],
			'isci' => $request['isci'],
			'music_track' => $request['music_track'],
			'youtube_link' => $request['youtube_link']
		]);

		return $project;
	}

	public function deleteRecord($id){
		$project = $this->project->find($id);
		$project->delete();

		return $project;
	}

	public function uploadYouTubeVideo($request, $project){
		// $proj = $this->project->findOrFail($project);
		$proj = $this->showRecord($project);
		$videoPath = $request->file('video')->getRealPath();
		$videoExt = $request->file('video')->getClientOriginalExtension();
		$videoName = str_slug($request['video_title']).'.'.$videoExt;

		// $aws = Storage::disk('s3')->put($this->getFilePath($videoName), file_get_contents($videoPath));

		$video = \Youtube::upload($request->video->path(),[
			'title' => $request['video_title'],
			'description' => $request['description']
		], 'unlisted');

		$proj->youtube_link = $video->getVideoId();
		$proj->save();

		return 'true';

	}

	private function produceDate($dateString){
		$date = explode('/', $dateString);
		return $date;
	}	

	private function getFilePath($file){
		return 'videos/'.$file;
	}
}
