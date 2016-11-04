@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('agencies.index')}}">Agencies</a></li>
				  <li class="active">{{$agency->agency_name}}</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-10 col-md-offset-1" style="margin-bottom:20px;">
				<a href="{{route('agencies.edit', $agency->slug)}}" class="btn btn-default" style="margin-right:10px;">Edit Record</a>
				{!! Form::open(['route' => ['agencies.destroy', $agency->id], 'method' => 'DELETE', 'class' => 'delete', 'style' => 'margin:0; padding:0;display:inline;']) !!}
					{{Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
				{!! Form::close() !!}
			</div>
		</div>

	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-primary">
	                <div class="panel-heading"><strong>{{$agency->agency_name}}</strong></div>
	                <div class="panel-body">
	                    <div class="row">
	                    	<div class="col-sm-3 col-xs-6">
	                    		<p><strong>Contact's Name</strong></p>
	                    		<p style="margin-top:-15px;">{{$agency->contact_full_name}}</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-6">
	                    		<p><strong>Contact's Phone</strong></p>
	                    		<p style="margin-top:-15px;">{{$agency->contact_phone}}</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-6">
	                    		<p><strong>Contact's Email</strong></p>
	                    		<p style="margin-top:-15px;">{{$agency->contact_email}}</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-6">
	                    		<p><strong>{{ str_plural('Client', $agency->clients->count()) }}</strong></p>
	                    		<p style="margin-top:-15px;">{{$agency->clients->count()}}</p>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Clients</div>
	                <div class="panel-body">
	                	@if($agency->clients->count())
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
	    		    		    		@foreach($agency->clients as $client)
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
	@if(session()->has('message'))
		<script type="text/javascript">
			toastr.success('{!! session('message') !!}');
		</script>
	@endif
@endsection
