<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ae;
use App\Agency;
use App\Http\Requests;
use App\Http\Requests\ClientRequest;
use App\SalesConnect\Helpers\FlashMessageHelper as Flash;
use App\SalesConnect\Helpers\Interfaces\ClientInterface;

class ClientController extends Controller
{
    protected $client;
    protected $ae;
    protected $agency;
    protected $flash;

    public function __construct(ClientInterface $client, Ae $ae, Agency $agency, Flash $flash){
        $this->client = $client;
        $this->ae = $ae;
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
        $clients = $this->client->showAll();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resources = $this->getResources();
        return view('clients.create', compact('resources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        // return $request->all();
        $client = $this->client->createRecord($request);
        return redirect()->route('clients.show', $client->slug)
                         ->with($this->flash->created($client->company_name));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->client->showRecord($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = $this->client->showRecord($id);
        $resources = $this->getResources($client);
        return view('clients.edit', compact('client','resources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $client = $this->client->updateRecord($request, $id);
        return redirect()->route('clients.show', $client->slug)
                         ->with($this->flash->updated($client->company_name));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = $this->client->deleteRecord($id);
        return redirect()->route('clients.index')->with($this->flash->deleted($client->company_name));
    }

    public function getResources($client = null){
        $aes = $this->ae->get()->sortBy('full_name')->pluck('full_name', 'id');
        $agencies = $this->agency->get()->sortBy('agency_name')->pluck('agency_name', 'id');
        $client ? $myAes = $client->aes()->get()->pluck('id')->toArray() : $myAes = null;
        return [
            'aes' => $aes,
            'agencies' => $agencies,
            'myAes' => $myAes
        ];
    }
}
