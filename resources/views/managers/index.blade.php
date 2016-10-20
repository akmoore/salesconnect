@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li class="active">Managers</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Managers</div>
	                <div class="panel-body">
	                	<a href="{{route('managers.create')}}" class="btn btn-primary">Create</a>
	                	@if($managers->count())
	                		<div class="table-responsive" style="margin-top:15px;">
			                    <table class="table">
			                      <thead>
			                      	<tr>
			                      		<th>Name</th>
			                      		<th>W Phone</th>
			                      		<th>C Phone</th>
			                      		<th>Email</th>
			                      		<th>AEs</th>
			                      	</tr>
			                      </thead>
			                      <tbody>
				                      	@foreach($managers as $manager)
				                      		<tr>
				                      			<td>
				                      				<a href="{{route('managers.show', ['id' => $manager->slug])}}">
				                      					{!! $manager->full_name !!} (<span>{!! strtoupper($manager->team) !!}</span>)
				                      				</a>
				                      			</td>
				                      			<td>{!! $manager->work_phone !!}</td>
				                      			<td>{!! $manager->cell_phone !!}</td>
				                      			<td>{!! $manager->email !!}</td>
				                      			<td>{!!	$manager->aes->count() !!}</td>
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