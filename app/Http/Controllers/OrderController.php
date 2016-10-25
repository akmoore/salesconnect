<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SalesConnect\Helpers\Interfaces\OrderInterface;

use Vsmoraes\Pdf\Pdf;

class OrderController extends Controller
{
    protected $order;
    protected $pdf;

    public function __construct(OrderInterface $order, Pdf $pdf){
        $this->order = $order;
        $this->pdf = $pdf;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('orders.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($proj, $id)
    {
        // return [$project, $id];
        $project = $this->order->getProject($proj);
        $order = $this->order->showRecord($id);
        return view('orders.edit', compact('project', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project, $id)
    {
        $order = $this->order->updateRecord($request, $id);
        return redirect()->route('projects.show', $project);
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

    public function pdf($project, $order){

        $info = $this->order->getPdfInfo($project, $order);
        // return $info['agency'];
        // return $info['project']->client->agency;

        $html = view('orders.show', compact('info'))->render();

        return $this->pdf
            ->load($html)
            ->show();
    }
}
