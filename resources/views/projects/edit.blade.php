@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('projects.index')}}">Projects</a></li>
				  <li><a href="{{route('clients.show', $project->client->slug)}}">{{$project->client->company_name}}</a></li>
				  <li><a href="{{route('projects.show', $project->slug)}}">{{$project->title}}</a></li>
				  <li class="active">Edit</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Edit Project</div>

	                <div class="panel-body">
	                    {!! Form::model($project, ['route' => ['projects.update', $project->slug], 'method' => 'PUT']) !!}
	                        <div class="row">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('client_id')? 'has-error':''}}">
	                        		    {!! Form::label('client_id', 'Select Client') !!}
	                        		    {!! Form::select('client_id', $resources['clients'], null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        
	                        <div class="row" style="margin-top:20px;">
	                        	<div class="col-sm-9">
	                        		<div class="form-group {{$errors->has('title')? 'has-error':''}}">
	                        		    {!! Form::label('title', 'Title of Project') !!}
	                        		    {!! Form::text('title', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-3">
	                        		<div class="form-group {{$errors->has('new_client')? 'has-error':''}}">
	                        		    {!! Form::label('new_client', 'New Client&#63;') !!}
	                        		    {!! Form::select('new_client', [1 => 'Yes', 0 => 'No'], 0, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('start_date')? 'has-error':''}}">
	                        		    {!! Form::label('start_date', 'Start Date') !!}
	                        		    {!! Form::text('start_date', $project->start_date->format('m/d/Y'), ['class' => 'form-control date']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('end_date')? 'has-error':''}}">
	                        		    {!! Form::label('end_date', 'End Date') !!}
	                        		    {!! Form::text('end_date', $project->end_date ? $project->end_date->format('m/d/Y') : null, ['class' => 'form-control date']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        
	                        <div class="row">
	                        	<div class="col-sm-3">
	                        		<div class="form-group {{$errors->has('length')? 'has-error':''}}">
	                        		    {!! Form::label('length', 'Length') !!}
	                        		    {!! Form::select('length', $resources['length'], 30, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-3">
	                        		<div class="form-group {{$errors->has('production_free')? 'has-error':''}}">
	                        		    {!! Form::label('production_free', 'Free&#63;') !!}
	                        		    {!! Form::select('production_free', [1 => 'Yes', 0 => 'No'], 1, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-3">
	                        		<div class="form-group {{$errors->has('production_promotional')? 'has-error':''}}">
	                        		    {!! Form::label('production_promotional', 'Promotional&#63;') !!}
	                        		    {!! Form::select('production_promotional', [1 => 'Yes', 0 => 'No'], 0, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-3">
	                        		<div class="form-group {{$errors->has('air_date')? 'has-error':''}}">
	                        		    {!! Form::label('air_date', 'Air Date') !!}
	                        		    {!! Form::text('air_date', $project->air_date->format('m/d/Y'), ['class' => 'form-control date']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-3">
	                        		<div class="form-group {{$errors->has('c_number')? 'has-error':''}}">
	                        		    {!! Form::label('c_number', 'C Number') !!}
	                        		    {!! Form::text('c_number', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('isci')? 'has-error':''}}">
	                        		    {!! Form::label('isci', 'ISCI') !!}
	                        		    {!! Form::text('isci', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-5">
	                        		<div class="form-group {{$errors->has('music_track')? 'has-error':''}}">
	                        		    {!! Form::label('music_track', 'Music Track') !!}
	                        		    {!! Form::text('music_track', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row" style="margin-top:20px;">
	                        	<div class="col-sm-12">
	                        		<div class="form-group">
	                        		    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                      
	                    {!! Form::close() !!}

	                    <div class="row">
	                    	<div class="col-sm-12">
                    			@if($errors->any())
                    				<div class="well">
                    					<ol>
                    						@foreach($errors->all() as $error)
                    							<li>{{$error}}</li>
                    						@endforeach
                    					</ol>
                    				</div>
                    			@endif
	                    	</div>
	                    </div>
	                    	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

@endsection()

@section('scripts')
	<script type="text/javascript">
		(function(){
			$( ".date" ).dateDropper();
		})();
	</script>
@endsection