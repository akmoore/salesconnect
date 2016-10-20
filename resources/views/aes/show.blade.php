@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('aes.index')}}">Account Executives</a></li>
				  <li class="active">{{$ae->full_name}}</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2" style="margin-bottom:20px;">
				<a href="{{route('aes.edit', $ae->slug)}}" class="btn btn-default" style="margin-right:10px;">Edit Record</a>
				{!! Form::open(['route' => ['aes.destroy', $ae->id], 'method' => 'DELETE', 'class' => 'delete', 'style' => 'margin:0; padding:0;display:inline;']) !!}
					{{Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
				{!! Form::close() !!}
			</div>
		</div>

	    <div class="row">
	        <div class="col-sm-8 col-sm-offset-2">
	            <div class="panel panel-primary">
	                <div class="panel-heading"><strong>{{$ae->full_name}}</strong></div>
	                <div class="panel-body">
	                    <div class="row">
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Email</strong></p>
	                    		<p style="margin-top:-15px;">{{$ae->email}}</p>
	                    	</div>
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Work Phone</strong></p>
	                    		<p style="margin-top:-15px;">{{$ae->work_phone}}</p>
	                    	</div>
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Cell Phone</strong></p>
	                    		<p style="margin-top:-15px;">{{$ae->cell_phone}}</p>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Projects</strong></p>
	                    		<p style="margin-top:-15px;">{{$ae->clients->map(function($client){return $client->projects;})->flatten()->count()}}</p>
	                    	</div>
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>{{ str_plural('Client', $ae->clients->count()) }}</strong></p>
	                    		<p style="margin-top:-15px;">{{$ae->clients->count()}}</p>
	                    	</div>
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Team | Manager</strong></p>
	                    		<p style="margin-top:-15px;">{{strtoupper($ae->manager->team)}} | 
	                    		<a href="{{route('managers.show', $ae->manager->slug)}}">{{$ae->manager->full_name}}</a></p>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- <div class="row">
	        <div class="col-sm-8 col-sm-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Clients</div>
	                <div class="panel-body">
	                	@if($ae->clients->count())
	        		  		<div class="table-responsive" style="margin-top:10px;">
	    	    		    	<table class="table table-hover ">
	    	    		    	  	<thead>
	    		    		    	    <tr>
	    			    		    	    <th>Client</th>
	    			    		    	    <th>POC</th>
	    			    		    	    <th>POC Phone</th>
	    			    		    	    <th>POC Email</th>
	    			    		    	    <th>Projects</th>
	    		    		    	    </tr>
	    		    		    	</thead>
	    		    		    	<tbody>
	    		    		    		@foreach($ae->clients as $client)
		    		    		    	    <tr>
		    		    		    	      	<td><a href="{{route('clients.show', $client->slug)}}">{{$client->company_name}}</a></td>
		    		    		    	      	<td>{{ $client->contact_full_name }}</td>
		    		    		    	      	<td>{{ $client->primary_contact_phone }}</td>
		    		    		    	      	<td>{{ $client->primary_contact_email }}</td>
		    		    		    	      	<td>3</td>
		    		    		    	    </tr>
	    		    		    	    @endforeach
	    		    		    	</tbody>
	    	    		    	</table>
	        		  		</div>
	        		  	@else
	        		  		<p>Currently, there are no Clients.</p>
        		  		@endif
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row">
	        <div class="col-sm-8 col-sm-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Projects</div>
	                <div class="panel-body">
	                	@if($projects)
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
	    		    		    		@foreach($projects as $project)
		    		    		    	    <tr>
		    		    		    	      	<td><a href="{{route('projects.show', $project['slug'])}}">{{$project['title']}}</a></td>
		    		    		    	      	<td>{{ $project['active'] }}</td>
		    		    		    	      	<td>{{ $project['air_date'] }}</td>
		    		    		    	      	<td>{{ $project['isci'] }}</td>
		    		    		    	      	<td>{{ $project['c_number'] }}</td>
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
	    </div> -->
	    <!-- 'title'
	    'slug'
	    active'
	    air_date
	    c_number
	    'isci' -->

	    <div class="row">
	    	<div class="col-sm-8 col-sm-offset-2">
	    		<ul class="nav nav-tabs">
	    		  	<li class="active"><a href="#clients" data-toggle="tab" aria-expanded="true">Clients</a></li>
	    		  	<li class=""><a href="#projects" data-toggle="tab" aria-expanded="false">Projects</a></li>
	    		</ul>
	    		<div id="myTabContent" class="tab-content">
	    		  	<div class="tab-pane fade active in" id="clients">
	    		  		@if($ae->clients->count())
	        		  		<div class="table-responsive" style="margin-top:10px;">
	    	    		    	<table class="table table-hover ">
	    	    		    	  	<thead>
	    		    		    	    <tr>
	    			    		    	    <th>Client</th>
	    			    		    	    <th>POC</th>
	    			    		    	    <th>POC Phone</th>
	    			    		    	    <th>POC Email</th>
	    			    		    	    <th>Projects</th>
	    		    		    	    </tr>
	    		    		    	</thead>
	    		    		    	<tbody>
	    		    		    		@foreach($ae->clients as $client)
		    		    		    	    <tr>
		    		    		    	      	<td><a href="{{route('clients.show', $client->slug)}}">{{$client->company_name}}</a></td>
		    		    		    	      	<td>{{ $client->contact_full_name }}</td>
		    		    		    	      	<td>{{ $client->primary_contact_phone }}</td>
		    		    		    	      	<td>{{ $client->primary_contact_email }}</td>
		    		    		    	      	<td>{{ $client->projects->filter(function($project){ return $project->active == 1;})->count()}} /{{ $client->projects->count() }}</td>
		    		    		    	    </tr>
	    		    		    	    @endforeach
	    		    		    	</tbody>
	    	    		    	</table>
	        		  		</div>
	        		  	@else
	        		  		<p>Currently, there are no Clients.</p>
        		  		@endif
	    		  	</div>
	    		  	<div class="tab-pane fade" id="projects">
	    		  		@if($projects)
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
	    		    		    		@foreach($projects as $project)
		    		    		    	    <tr>
		    		    		    	      	<td><a href="{{route('projects.show', $project['slug'])}}">{{$project['title']}}</a></td>
		    		    		    	      	<td>{{ $project['active'] }}</td>
		    		    		    	      	<td>{{ $project['air_date'] }}</td>
		    		    		    	      	<td>{{ $project['isci'] }}</td>
		    		    		    	      	<td>{{ $project['c_number'] }}</td>
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
	    </div><!-- end of tabs -->
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