@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li class="active">Account Executives</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Account Executives</div>
	                <div class="panel-body">
	                	<a href="{{route('aes.create')}}" class="btn btn-primary">Create</a>
	                    @if($aes->count())
		                    <div class="table-responsive" style="margin-top:15px;">
			                    <table class="table" style="margin-top:10px;">
			                      <thead>
			                      	<tr>
			                      		<th>Name</th>
			                      		<th>Projects</th>
			                      		<th>W Phone</th>
			                      		<th>C Phone</th>
			                      		<th>Email</th>
			                      		<th>Team | Manager</th>
			                      	</tr>
			                      </thead>
			                      <tbody>
			                      	@foreach($aes as $ae)
			                      		<tr>
			                      			<td>
			                      				<a href="{{route('aes.show', ['id' => $ae->slug])}}">
			                      					{!! $ae->full_name !!}
			                      				</a>
			                      			</td>
			                      			<td>
			                      				{!! $ae->clients->map(function($client){ return $client->projects->filter(function($project){ return $project->active == 0;});})->count() !!} / {!! $ae->clients->map(function($client){return $client->projects;})->count() !!}
			                      			</td>
			                      			<td>{!! $ae->work_phone !!}</td>
			                      			<td>{!! $ae->cell_phone !!}</td>
			                      			<td>{!! $ae->email !!}</td>
			                      			<td>{!! strtoupper($ae->manager->team) !!} | {!!	$ae->manager->full_name !!}</td>
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

@section('scripts')
	@if(session()->has('message'))
		<script type="text/javascript">
			toastr.success('{!! session('message') !!}');
		</script>
	@endif
@endsection

