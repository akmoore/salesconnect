<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AgencyRequest;
use App\SalesConnect\Helpers\FlashMessageHelper;
use App\SalesConnect\Helpers\Interfaces\AgencyInterface;

class AgencyController extends Controller
{
    protected $agency;
    protected $flash;

    public function __construct(AgencyInterface $agency, FlashMessageHelper $flash){
        $this->agency = $agency;
        $this->flash = $flash;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = $this->agency->showAll();
        return view('agencies.index', compact('agencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyRequest $request)
    {
        $agency = $this->agency->createRecord($request);
        return redirect()->route('agencies.index')
                         ->with($this->flash->created($agency->agency_name));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agency = $this->agency->showRecord($id);
        return view('agencies.show', compact('agency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agency = $this->agency->showRecord($id);
        return view('agencies.edit', compact('agency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgencyRequest $request, $id)
    {
        $agency = $this->agency->updateRecord($request, $id);
        return redirect()->route('agencies.show', $agency->slug)
                         ->with($this->flash->updated($agency->agency_name));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agency = $this->agency->deleteRecord($id);

        if(!$agency) return redirect()->back();

        return redirect()->route('agencies.index')
                         ->with($this->flash->deleted($agency->agency_name));

    }
}
