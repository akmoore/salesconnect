<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Campaign;
use Carbon\Carbon;

class CampaignController extends Controller
{
    protected $campaign;

    public function __construct(Campaign $campaign){
        $this->campaign = $campaign;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $ccode = $this->getCCode($request['display_name']);

        $campaign = $this->campaign->create([
            'display_name' => $request['display_name'],
            'ccode' => $ccode
        ]);

        return $campaign;
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function getCCode($request){
        $dpn = collect(explode(' ', $request))
               ->map(function($part){return $part[0];})
               ->filter(function($nan){return !is_numeric($nan);})
               ->toArray();
        return $dpn_collect = implode('', $dpn) . '_' . Carbon::now()->month . Carbon::now()->year;
    }
}
