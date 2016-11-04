<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CalendarRequest;
use App\SalesConnect\Helpers\FlashMessageHelper as Flash;
use App\SalesConnect\Helpers\Interfaces\CalendarInterface;

class CalendarController extends Controller
{
    protected $event;
    protected $flash;

    public function __construct(CalendarInterface $event, Flash $flash){
        $this->event = $event;
        $this->flash = $flash;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'Here lies the calendar';
        // return $events = $this->event->showAll();
        $now = \Carbon\Carbon::now('America/Chicago');
        $events = collect($this->composeEventsArray());


        // return $events->map(function($event) use ($now){return [$event['start_timestamp'], $now->diffInHours(\Carbon\Carbon::parse($event['start_timestamp']))];})->filter(function($event) use ($now){return \Carbon\Carbon::parse($event[0]) > $now;});


        return view('events.index', compact('events'));
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
        if(!$event = $this->event->createRecord($request)) return redirect()->back()->with($this->flash->event_error());
        return redirect()->route('projects.show', $project)
                         ->with($this->flash->created());

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
        if(!$event = $this->event->updateRecord($request, $id)) return redirect()->back()->with($this->flash->event_error());
        return redirect()->route('projects.show', $project)
                         ->with($this->flash->updated());
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

        return redirect()->back()->with($this->flash->deleted());
    }

    public function composeEventsArray(){
        $events = $this->event->showAll();
        $data = [];
        foreach ($events as $key => $event) {
            $data[] = [
                "id" => $event->id,
                "title" => $event->project->title . ' - ' . title_case($event->event_type),
                "color" => $event->class_color,
                "start" => $event->start_date_time,
                "end" => $event->end_date_time,
                "start_timestamp" => $event->start_date_timestamp,
                "end_timestamp" => $event->end_date_timestamp
            ];
        }

        return $data;
    }
}















