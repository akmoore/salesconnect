<?php

namespace App\SalesConnect\Helpers\Repositories;

use Storage;
use App\Project;
use App\Note;
use App\Client;
use Carbon\Carbon;
use App\Events\ProjectWasCreated;
use App\Events\Project\LogActivity;
use App\SalesConnect\Helpers\ExtractedListTrait;
use App\SalesConnect\Helpers\Interfaces\ProjectInterface;

class ProjectRepo implements ProjectInterface{

	use ExtractedListTrait;

	protected $project;
	protected $note;
	protected $client;

	public function __construct(Project $project, Note $note, Client $client){
		$this->project = $project;
		$this->note = $note;
		$this->client = $client;
	}

	public function showAll(){
		return $this->project->with('client.aes.manager')->get()->sortBy('title');
	}

	public function showRecord($id){
		return $this->project->with('client.aes.manager', 'notes', 'progress', 'campaign')->whereSlug($id)->firstOrFail();
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
		$ci = $this->getClientInitials($request['client_id']);
		$project = $this->project->create([
			'client_id' => $request['client_id'],
			'campaign_id' => $request['campaign_id'],
			'title' => $request['title'],
			'active' => 1,
			'new_client' => $request['new_client'],
			'start_date' => Carbon::now('America/Chicago'),
			'length' => $request['length'],
			'production_free' => $request['production_free'],
			'production_promotional' => $request['production_promotional'],
			'air_date' => Carbon::createFromDate($pd[2], $pd[0], $pd[1], 'America/Chicago'),
			'isci' => $ci.'_'.ucfirst(camel_case($request['title'])).'_'.\Carbon\Carbon::now()->year.'_HD'
		]);



		//Create note for project.
		event(new ProjectWasCreated($request, $project));
		event(new LogActivity('project', 'created', $project));
		return $project;
	}

	public function updateRecord($request, $id){
		$project = $this->showRecord($id);
		$originalProjectData = $this->extractOriginal($project);
		$airDate = $this->produceDate($request['air_date']);
		$endDate = $this->produceDate($request['end_date']);
		$project->update([
			'client_id' => $request['client_id'],
			'title' => $request['title'],
			'new_client' => $request['new_client'],
			'length' => $request['length'],
			'production_free' => $request['production_free'],
			'production_promotional' => $request['production_promotional'],
			'air_date' => (string)$airDate[2].'-'.(string)$airDate[0].'-'.(string)$airDate[1],
			'end_date' => $request['end_date'] != '' ? (string)$endDate[2].'-'.(string)$endDate[0].'-'.(string)$endDate[1]
													 : null,//was set to null, because progress should set it once project is done.
			'c_number' => $request['c_number'],
			'isci' => $request['isci'],
			'music_track' => $request['music_track'],
			'youtube_link' => $request['youtube_link']
		]);

		$extractedList = $this->extractOriginalValues($originalProjectData, $project); 
		
		event(new LogActivity('project', 'updated', $project, $extractedList));

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

	private function getClientInitials($id){
		$client = $this->client->find($id);
		$initials_array = collect(explode(' ', $client->company_name))->map(function($title){return $title[0];})->toArray();
		return implode('',$initials_array);
	}

}





