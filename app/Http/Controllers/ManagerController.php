<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SalesConnect\Helpers\Interfaces\ManagerInterface;
use App\Http\Requests\ManagerRequest;

class ManagerController extends Controller
{
    protected $manager;

    public function __construct(ManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = $this->manager->showAll();
        return view('managers.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('managers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerRequest $request)
    {
        

        $manager = $this->manager->createRecord($request);
        return redirect()->route('managers.show', $manager->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manager = $this->manager->showRecord($id);
        $aes = $this->manager->getAes($id);
        $projectsCount = $this->aesCount($aes);
        return view('managers.show', compact('manager', 'aes', 'projectsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manager = $this->manager->showRecord($id);
        return view('managers.edit', compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerRequest $request, $id)
    {
        // return $manager = \App\Manager::whereSlug('amber-rose')->first();

        $manager = $this->manager->updateRecord($request, $id);
        return redirect()->route('managers.show', $manager->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clearedAes = $this->manager->clearedAes($id);

        if(!$clearedAes) return redirect()->back();

        return redirect()->route('managers.index');
    }

    public function aesCount($aes){
        $total  = $aes->map(function($ae){ return $ae->clients->map(function($client){ return $client->projects;});})->flatten()->unique()->count();
        $active = $aes->map(function($ae){ return $ae->clients->map(function($client){ return $client->projects->filter(function($project){return $project->active === 1;});});})->flatten()->unique()->count();

        return [
            'total' => $total,
            'active' => $active
        ];
    }
}
