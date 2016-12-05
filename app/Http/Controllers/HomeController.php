<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use \Carbon\Carbon;

class HomeController extends Controller
{
    protected $projects;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Project $projects)
    {
        $this->middleware('auth');
        $this->projects = $projects;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->projects->with('client', 'events', 'progress')->where('active', 1)->orderBy('created_at', 'DESC')->get();
        $chartData = $this->chartData();
        return view('home', compact('projects','chartData'));
    }

    public function chartData(){

        $carbonMonth = Carbon::now()->month;

        return $data = [
            'projects' => [
                'labels' => [
                    $this->labels($carbonMonth - 5),
                    $this->labels($carbonMonth - 4),
                    $this->labels($carbonMonth - 3),
                    $this->labels($carbonMonth - 2),
                    $this->labels($carbonMonth - 1),
                    $this->labels($carbonMonth),
                ],
                'count' => [
                    $this->projects->whereMonth('created_at', $carbonMonth - 5)->count(),
                    $this->projects->whereMonth('created_at', $carbonMonth - 4)->count(),
                    $this->projects->whereMonth('created_at', $carbonMonth - 3)->count(),
                    $this->projects->whereMonth('created_at', $carbonMonth - 2)->count(),
                    $this->projects->whereMonth('created_at', $carbonMonth - 1)->count(),
                    $this->projects->whereMonth('created_at', $carbonMonth)->count()
                ]
            ],
            'earnings' => [
                'labels' => [
                    $this->labels($carbonMonth - 5),
                    $this->labels($carbonMonth - 4),
                    $this->labels($carbonMonth - 3),
                    $this->labels($carbonMonth - 2),
                    $this->labels($carbonMonth - 1),
                    $this->labels($carbonMonth),
                ],
                'profits' => [
                    $this->getProfit($carbonMonth - 5),
                    $this->getProfit($carbonMonth - 4),
                    $this->getProfit($carbonMonth - 3),
                    $this->getProfit($carbonMonth - 2),
                    $this->getProfit($carbonMonth - 1),
                    $this->getProfit($carbonMonth),
                ]
            ]
        ];

        // projects => project.length
    }

    public function labels ($number){
        $months = [
            'January', 'February', 'March', 'April',
            'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];

        return $months[$number - 1];
    }

    public function getProfit($number){
        return $this->projects
                    ->whereMonth('created_at', $number)
                    ->get()
                    ->map(function($project){return $project->order->order_total ;})
                    ->sum();
    }
}












