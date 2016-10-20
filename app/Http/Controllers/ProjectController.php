<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use App\Http\Requests;
use App\Http\Requests\ProjectRequest;
use App\SalesConnect\Helpers\Interfaces\ProjectInterface;

class ProjectController extends Controller
{
    protected $project;

    public function __construct(ProjectInterface $project, Client $client){
        $this->project = $project;
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->project->showAll();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resources = $this->resources();
        return view('projects.create', compact('resources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = $this->project->createRecord($request);
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = $this->project->showRecord($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = $this->project->showRecord($id);
        $resources = $this->resources();
        return view('projects.edit', compact('project','resources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = $this->project->updateRecord($request, $id);
        return redirect()->route('projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = $this->project->deleteRecord($id);
        return redirect()->route('projects.index');
    }

    public function resources(){
        $clients = $this->client->get()->sortBy('company_name')->pluck('company_name', 'id');
        $length = [ 5   => '00:05', 10  => '00:10', 15  => '00:15', 30  => '00:30',
                    45  => '00:45', 60  => '01:00', 90  => '01:30', 120 => '02:00',
                    121 => 'Greater than two minutes'];

        return [
            'clients' => $clients,
            'length'  => $length
        ];
    }

    public function youtube(Request $request, $project){
        // return [$request->all(), $request->video, $project];
        // return $request->hasFile('video') ? $request->video->extension() : 'No';
        return $this->project->uploadYouTubeVideo($request, $project);
        if(!$this->project->uploadYouTubeVideo($request, $project)) return redirect('/home');
        return redirect()->back();
    }
}









