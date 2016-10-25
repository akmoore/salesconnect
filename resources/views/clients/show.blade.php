@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('clients.index')}}">Clients</a></li>
				  <li class="active">{{$client->company_name}}</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1" style="margin-bottom:20px;">
				<a href="{{route('clients.edit', $client->slug)}}" class="btn btn-default" style="margin-right:10px;">Edit Record</a>
				{!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'DELETE', 'class' => 'delete', 'style' => 'margin:0; padding:0;display:inline;']) !!}
					{{Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
				{!! Form::close() !!}
			</div>
		</div>

	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-1">
	            <div class="panel panel-primary">
	                <div class="panel-heading"><strong>{{$client->company_name}}</strong></div>
	                <div class="panel-body">
	                	<div class="row">
	                    	<div class="col-sm-12 col-xs-12">
	                    		<p><strong>Address</strong></p>
	                    		<p style="margin-top:-15px;">{{$client->street}}, {{$client->city}}, {{$client->state}}, {{$client->postal}}</p>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-md-3 col-sm-6 col-xs-6">
	                    		<p><strong>Public Phone</strong></p>
	                    		<p style="margin-top:-15px;">{{$client->public_phone}}</p>
	                    	</div>
	                    	<div class="col-md-3 col-sm-6 col-xs-6">
	                    		<p><strong>Website</strong></p>
	                    		<p style="margin-top:-15px;">{{$client->url}}</p>
	                    	</div>
	                    	<div class="col-md-3 col-sm-6 col-xs-6">
	                    		<p><strong>Agency</strong></p>
	                    		<p style="margin-top:-15px;">
	                    		@if($client->agency)
	                    			<a href="{{route('agencies.show', $client->agency->slug)}}">{{$client->agency->agency_name}}</a>
	                    		@else
	                    			N/A
	                    		@endif
	                    		</p>
	                    	</div>
	                    	<div class="col-md-3 col-sm-6 col-xs-6">
	                    		<p><strong>Account {{ str_plural('Executive', $client->aes->count()) }}</strong></p>
	                    		<p style="margin-top:-15px;">
                    				@foreach($client->aes as $ae)
                    					<a href="{{route('aes.show', $ae->slug)}}">{{$ae->full_name}}</a>@if($client->aes->last()->id !== $ae->id), @endif
                    				@endforeach
	                    		</p>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-md-3 col-sm-6 col-xs-6">
	                    		<p><strong>Contact's Name</strong></p>
	                    		<p style="margin-top:-15px;">{{$client->contact_full_name}}</p>
	                    		<p style="margin-top:-22px;">
	                    			<em>
		                    			<small>
		                    				@if($client->primary_contact_title)
		                    					({{$client->primary_contact_title}})
		                    				@endif
		                    			</small>
	                    			</em>
	                    		</p>
	                    	</div>
	                    	<div class="col-md-3 col-sm-6 col-xs-6">
	                    		<p><strong>Contact's Phone</strong></p>
	                    		<p style="margin-top:-15px;">{{$client->primary_contact_phone}}</p>
	                    	</div>
	                    	<div class="col-md-3 col-sm-6 col-xs-6">
	                    		<p><strong>Contact's Email</strong></p>
	                    		<p style="margin-top:-15px;">{{str_limit($client->primary_contact_email, 20)}}</p>
	                    	</div>
	                    	<div class="col-md-3 col-sm-6 col-xs-6">
	                    		<p><strong>Projects</strong></p>
	                    		<p style="margin-top:-15px;">{{$client->projects->count()}}</p>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Projects <a href="{{route('projects.create', ['client' => $client->id])}}" class="btn btn-sm btn-default pull-right">New Project</a></div>
	                <div class="panel-body">
	    		  		@if($client->projects->count())
	        		  		<div class="table-responsive" style="margin-top:10px;">
	    	    		    	<table class="table table-hover ">
	    	    		    	  	<thead>
	    		    		    	    <tr>
	    			    		    	    <th>Title</th>
	    			    		    	    <th>Active</th>
	    			    		    	    <th>Air Date</th>
	    			    		    	    <th>ISCI</th>
	    			    		    	    <th>C Number</th>
	    		    		    	    </tr>
	    		    		    	</thead>
	    		    		    	<tbody>
	    		    		    		@foreach($client->projects as $project)
		    		    		    	    <tr>
		    		    		    	      	<td><a href="{{route('projects.show', $project->slug)}}">{{$project->title}}</a></td>
		    		    		    	      	<td>{{ $project->active ? 'Yes' : 'No'}}</td>
		    		    		    	      	<td>{{ $project->air_date ? $project->air_date->format('m/d/Y') : 'Not Set'}}</td>
		    		    		    	      	<td>{{ $project->isci ? $project->isci : 'Not Set' }}</td>
		    		    		    	      	<td>{{ $project->c_number ? $project->c_number : 'Not Set' }}</td>
		    		    		    	    </tr>
	    		    		    	    @endforeach
	    		    		    	</tbody>
	    	    		    	</table>
	        		  		</div>
	        		  	@else
	        		  		<p>Currently, there are no Projects.</p>
        		  		@endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
	    document.querySelector('.delete').onsubmit = function(evnt){
	        // console.log(evnt.type);
	        evnt.preventDefault();
	        // evnt.stopPropagation();
	        swal({
	            title: "Are you sure?",
	            text: "You will not be able to recover this imaginary file!",
	            type: "warning",
	            showCancelButton: true,
	            confirmButtonColor: '#DD6B55',
	            confirmButtonText: 'Yes, delete it!',
	            closeOnConfirm: false
	        },
	        function(){
	            swal({title:"Deleted!", text:"Your imaginary file has been deleted!", type:"success"}, function(){
	                console.log('Goodbye');
	                document.querySelector('.delete').submit();
	            });
	        });
	    };
	</script>
@endsection