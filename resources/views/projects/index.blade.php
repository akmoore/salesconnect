@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li class="active">Projects</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-sm-8 col-sm-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Projects</div>
	                <div class="panel-body">
	                	<a href="{{route('projects.create')}}" class="btn btn-primary">Create</a>
	                    @if($projects->count())
		                    <div class="table-responsive" style="margin-top:15px;">
			                    <table class="table" style="margin-top:10px;">
			                      <thead>
			                      	<tr>
			                      		<th>Project</th>
			                      		<th>Progress</th>
			                      		<th>Client</th>
			                      		<th>AE</th>
			                      		<th>Last Log</th>
			                      	</tr>
			                      </thead>
			                      <tbody>
			                      	@foreach($projects as $project)
			                      		<tr>
			                      			<td>
			                      				<a href="{{route('projects.show', ['id' => $project->slug])}}">
			                      					{!! $project->title !!}
			                      				</a>
			                      			</td>
			                      			<td>{{$project->progress->sum}}&#37;</td>
			                      			<td>{{$project->client->company_name}}</td>
			                      			<td>
			                      				@foreach($project->client->aes as $ae)
			                      					@if ($loop->last) 
			                      						{{$ae->full_name}} 
			                      					@else
			                      						{{$ae->full_name}},
			                      					@endif
			                      					
			                      				@endforeach
			                      			</td>
			                      			<td>09/23/2016 (PLog)</td>
			                      		</tr>
			                      	@endforeach
			                      </tbody>
			                    </table>
			                </div>
	                    @endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

