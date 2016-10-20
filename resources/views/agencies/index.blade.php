@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li class="active">Agencies</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Agencies</div>
	                <div class="panel-body">
	                	<a href="{{route('agencies.create')}}" class="btn btn-primary">Create</a>
	                    @if($agencies->count())
		                    <div class="table-responsive" style="margin-top:15px;">
			                    <table class="table" style="margin-top:10px;">
			                      <thead>
			                      	<tr>
			                      		<th>Name</th>
			                      		<th>Primary Contact</th>
			                      		<th>Phone</th>
			                      		<th>Email</th>
			                      		<th>Clients</th>
			                      	</tr>
			                      </thead>
			                      <tbody>
			                      	@foreach($agencies as $agency)
			                      		<tr>
			                      			<td>
			                      				<a href="{{route('agencies.show', ['id' => $agency->slug])}}">
			                      					{!! $agency->agency_name !!}
			                      				</a>
			                      			</td>
			                      			<td>{!! $agency->contact_full_name !!}</td>
			                      			<td>{!! $agency->contact_phone !!}</td>
			                      			<td>{!! $agency->contact_email !!}</td>
			                      			<td>{!! $agency->clients->count() !!}</td>
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

