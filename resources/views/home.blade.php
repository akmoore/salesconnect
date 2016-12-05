@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Charts</div>

                <div class="panel-body">
                    <!-- You are logged in! -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#projects" data-toggle="tab">Projects</a></li>
                        <li><a href="#earnings" data-toggle="tab">Earnings</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="projects">
                            <canvas id="projectsChart" width="400" height="120"></canvas>
                        </div>
                        <div class="tab-pane fade" id="earnings">
                            <canvas id="earningsChart" width="400" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Active Projects</div>
                <div class="panel-body">
                    @foreach ($projects->chunk(4) as $chunk)
                        <div class="row">
                            @foreach ($chunk as $project)
                                <div class="card-box col-md-3 col-sm-6">
                                    <div class="card">
                                        <!-- <div class="header">
                                            <img src="assets/img/lifestyle-8.jpg"/>
                                            <div class="filter"></div>
                                            
                                            <div class="actions">
                                                <button class="btn btn-round btn-fill btn-neutral btn-modern">
                                                    Read Article
                                                </button>
                                            </div>
                                        </div> -->
                                        <div class="content">
                                            <div class="progress">
                                              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{!! $project->progress->sum !!}" aria-valuemin="0" aria-valuemax="100" style="width: {!! $project->progress->sum !!}%;">
                                              </div>
                                            </div>
                                            <h6 class="category text-primary" style="margin-top: 20px;">
                                                <a href="{{ route('projects.show', $project->slug) }}">
                                                    {!! $project->title !!}
                                                </a>
                                            </h6>
                                            <table class="table table-condensed" style="margin-top: 10px;">
                                                <tbody>
                                                    <tr>
                                                        <td style="border-top: none;"><b>Client</b></td>
                                                        <td style="border-top: none;">
                                                            <a href="{!! route('clients.show', $project->client->slug) !!}">
                                                                {!! $project->client->company_name !!}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>AE</b></td>
                                                        <td>
                                                            @foreach($project->client->aes as $ae)
                                                                @if($loop->last)
                                                                    <a href="{!! route('aes.show', $ae->slug) !!}">
                                                                        {{$ae->full_name}}
                                                                    </a>
                                                                @else
                                                                    <a href="{!! route('aes.show', $ae->slug) !!}">
                                                                        {{$ae->full_name}},
                                                                    </a><br>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Start</b></td>
                                                        <td>{!! $project->created_at->format('m/d/Y') !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Event</b></td>
                                                        <td>
                                                            @if($project->events->count())
                                                                Type: {!! ucfirst($project->events->last()->event_type) !!}<br>
                                                                Date: {!! $project->events->last()->event_date->format('m/d/y') !!}<br>
                                                                Time: {!! $project->events->last()->event_date->format('g:ia') !!}
                                                            @else
                                                                No Events
                                                            @endif
                                                            
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>                                           
                                    </div> <!-- end card -->
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        
        (function(win,$){

            win.chartData = <?php echo json_encode($chartData); ?>

            var pChart = $("#projectsChart");
            var eChart = $("#earningsChart");
            var projectsChart = new Chart(pChart, {
                type: 'bar',
                data: {
                    labels: chartData.projects.labels,
                    datasets: [
                        {
                            label: 'Projects',
                            data: chartData.projects.count,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            var earningsChart = new Chart(eChart, {
                type: 'line',
                data: {
                    labels: chartData.earnings.labels,
                    datasets: [
                        {
                            label: 'Earnings',
                            data: chartData.earnings.profits,
                            backgroundColor:'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                                callback: function(value, index, values) {
                                  if(parseInt(value) > 1000){
                                    return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                  } else {
                                    return '$' + value;
                                  }
                                }
                            }
                        }]
                    }
                }
            });

        })(window, jQuery);

    </script>
@endsection
