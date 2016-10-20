@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('managers.index')}}">Managers</a></li>
				  <li class="active">{{$manager->full_name}}</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-10 col-md-offset-1" style="margin-bottom:20px;">
				<a href="{{route('managers.edit', $manager->slug)}}" class="btn btn-default" style="margin-right:10px;">Edit Record</a>
				{!! Form::open(['route' => ['managers.destroy', $manager->id], 'method' => 'DELETE', 'class' => 'delete', 'style' => 'margin:0; padding:0;display:inline;']) !!}
					{{Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
				{!! Form::close() !!}
			</div>
		</div>

	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-primary">
	                <div class="panel-heading"><strong>{{$manager->full_name}}</strong></div>
	                <div class="panel-body">
	                    <div class="row">
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Email</strong></p>
	                    		<p style="margin-top:-15px;">{{$manager->email}}</p>
	                    	</div>
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Work Phone</strong></p>
	                    		<p style="margin-top:-15px;"><a href="tel:{{$manager->work_phone}}">{{$manager->work_phone}}</a></p>
	                    		<!-- <p style="margin-top:-15px;">{{substr_replace(substr_replace(substr_replace($manager->work_phone,'(',0,0),') ',4,0),'-',9,0)}}</p> -->
	                    	</div>
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Cell Phone</strong></p>
	                    		<p style="margin-top:-15px;">{{$manager->cell_phone}}</p>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Team</strong></p>
	                    		<p style="margin-top:-15px;">{{strtoupper($manager->team)}}</p>
	                    	</div>
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Account Executives</strong></p>
	                    		<p style="margin-top:-15px;">{{$aes->count()}}</p>
	                    	</div>
	                    	<div class="col-sm-4 col-xs-6">
	                    		<p><strong>Projects</strong></p>
	                    		<p style="margin-top:-15px;"> {{$projectsCount['active']}} / {{$projectsCount['total']}}</p>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Account Executives</div>
	                <div class="panel-body">
	                	@if($aes->count())
	        		  		<div class="table-responsive" style="margin-top:10px;">
	    	    		    	<table class="table table-hover ">
	    	    		    	  	<thead>
	    		    		    	    <tr>
	    			    		    	    <th>Name</th>
	    			    		    	    <th>Clients</th>
	    			    		    	    <th>Projects</th>
	    		    		    	    </tr>
	    		    		    	</thead>
	    		    		    	<tbody>
	    		    		    		@foreach($aes as $ae)
		    		    		    	    <tr>
		    		    		    	      	<td><a href="{{route('aes.show', $ae->slug)}}">{{$ae->full_name}}</a></td>
		    		    		    	      	<td>{{$ae->clients->count()}}</td>
		    		    		    	      	<td>
		    		    		    	      		{{$ae->clients->map(function($client){return $client->projects;})->flatten()->count()}}
		    		    		    	      	</td>
		    		    		    	    </tr>
	    		    		    	    @endforeach
	    		    		    	</tbody>
	    	    		    	</table>
	        		  		</div>
	        		  	@else
	        		  		<p>Currently, there are no Account Executives.</p>
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