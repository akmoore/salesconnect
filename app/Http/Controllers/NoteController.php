<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NoteRequest;
use App\SalesConnect\Helpers\FlashMessageHelper as Flash;
use App\SalesConnect\Helpers\Interfaces\NoteInterface;

class NoteController extends Controller
{
    protected $note;
    protected $flash;

    public function __construct(NoteInterface $note, Flash $flash){
        $this->note = $note;
        $this->flash = $flash;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $project = $this->note->getProject($id);
        return view('notes.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request, $id)
    {
        $note = $this->note->createRecord($request);
        return redirect()->route('projects.show', $id)->with($this->flash->created('The note ' . $note->title));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project, $id)
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
        $project = $this->note->getProject($project);
        $note = $this->note->showRecord($id);
        return view('notes.edit', compact('project', 'note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, $project, $id)
    {
        // return ['request' => $request->all(), 'project' => $project, 'note' => $id];
        $note = $this->note->updateRecord($request, $id);
        return redirect()->route('projects.show', $project)->with($this->flash->updated('The note ' . $note->title));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project, $id)
    {   
        $proj = $this->note->getProject($project);
        $note = $this->note->deleteRecord($id);
        return redirect()->route('projects.show', $proj->slug)->with($this->flash->deleted('The note ' . $note->title));
    }
}
