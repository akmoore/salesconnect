<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CalendarRequest;
use App\SalesConnect\Helpers\Interfaces\CalendarInterface;

class CalendarController extends Controller
{
    protected $event;

    public function __construct(CalendarInterface $event){
        $this->event = $event;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show the Calendar Here
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project)
    {
        $project = $this->event->getProject($project);
        return view('events.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalendarRequest $request, $project)
    {
        // return ['request' => $request->all(), 'project' => $project];
        // return $this->event->createRecord($request);
        if(!$event = $this->event->createRecord($request)) return redirect()->back();
        return redirect()->route('projects.show', $project);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project, $id)
    {
        $project = $this->event->getProject($project);
        $event = $this->event->showRecord($id);
        return view('events.edit', compact('project', 'event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CalendarRequest $request, $project, $id)
    {
        if(!$event = $this->event->updateRecord($request, $id)) return redirect()->back();
        return redirect()->route('projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project, $id)
    {
        // return [$project, $id];
        if(!$event = $this->event->deleteRecord($id)) return redirect()->back();

        return redirect()->back();
    }
}
