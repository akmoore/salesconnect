<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AeRequest;
use App\SalesConnect\Helpers\PhoneHelperTrait;
use App\SalesConnect\Helpers\FlashMessageHelper as Flash;
use App\SalesConnect\Helpers\Interfaces\AeInterface as Ae;
// use App\SalesConnect\Helpers\Repositories\AeRepo as Ae;

class AeController extends Controller
{
    use PhoneHelperTrait;

    protected $ae;
    protected $flash;

    public function __construct(Ae $ae, Flash $flash){
        $this->ae = $ae;
        $this->flash = $flash;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aes = $this->ae->showAll();

        // return $this->showPhoneNumber($aes);

        return view('aes.index', compact('aes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return "Create a new Ae";
        $managers = $this->ae->getManagers();
        return view('aes.create', compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AeRequest $request)
    {
        $ae = $this->ae->createRecord($request);
        return redirect()->route('aes.show', $ae->slug)
                         ->with($this->flash->created($ae->full_name));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projects = $this->getProjects($id);
        $ae = $this->ae->showRecord($id);
        return view('aes.show', compact('ae', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ae = $this->ae->showRecord($id);
        $managers = $this->ae->getManagers();
        return view('aes.edit', compact('ae', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AeRequest $request, $id)
    {
        // return [$request->all(), $id];
        $ae = $this->ae->updateRecord($request, $id);
        return redirect()->route('aes.show', $ae->slug)
                         ->with($this->flash->updated($ae->full_name));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ae =  $this->ae->deleteRecord($id);

        if($ae) return redirect()->route('aes.index')
                                 ->with($this->flash->deleted($ae->full_name));
    }

    public function getProjects($id){       

        $ae = $this->ae->getProjects($id);

        if($ae->clients){
            $projects = $ae->clients->map(function($client){
                return $client->projects;
            });

            if($projects){
                $filter = $projects->flatten()->sortBy('title')->map(function($project){
                    return [
                        'title' => $project->title, 
                        'slug' => $project->slug,
                        'active' => $project->active ? 'Yes' : 'No',
                        'air_date' => $project->air_date->format('m/d/Y'),
                        'c_number' => $project->c_number ? $project->c_number : 'Not Set',
                        'isci' => $project->isci ? $project->isci : 'Not Set'
                    ];
                });
                return collect($filter);
            }else{
                return false;
            }            
        }else{
            return false;
        }
    }

    // public function showPhoneNumber($numbers){
    //     $phoneNumbers = [];

    //     foreach($numbers as $number){
    //         $phoneNumbers[] = $this->transformPhoneNumber($->work_phone);
    //     }

    //     return $phoneNumbers;
        
    // }
}






