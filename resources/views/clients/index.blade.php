@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li class="active">Clients</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Clients</div>
	                <div class="panel-body">
	                	<a href="{{route('clients.create')}}" class="btn btn-primary">Create</a>
	                    @if($clients->count())
		                    <div class="table-responsive" style="margin-top:15px;">
			                    <table class="table" style="margin-top:10px;">
			                      <thead>
			                      	<tr>
			                      		<th>Name</th>
			                      		<th>POC</th>
			                      		<th>POC Phone</th>
			                      		<th>POC Email</th>
			                      		<th>Projects</th>
			                      	</tr>
			                      </thead>
			                      <tbody>
			                      	@foreach($clients as $client)
			                      		<tr>
			                      			<td>
			                      				<a href="{{route('clients.show', ['id' => $client->slug])}}">
			                      					{!! $client->company_name !!}
			                      				</a>
			                      			</td>
			                      			<td>{!! $client->contact_full_name !!}</td>
			                      			<td>{!! $client->primary_contact_phone !!}</td>
			                      			<td>{!! $client->primary_contact_email !!}</td>
			                      			<td>{!! $client->projects->count() !!}</td>
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

