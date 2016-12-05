@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('projects.index')}}">Projects</a></li>
				  <li><a href="{{route('projects.show',$project->slug)}}">{{$project->title}}</a></li>
				  <li class="active">Create Event</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Create a New Event</div>

	                <div class="panel-body">
	                    {!! Form::model($event, ['route' => ['projects.events.update', $project->slug, $event->id], 'method'=>'PUT']) !!}
	                    	{!! Form::hidden('project_id', $project->id) !!}
	                        <div class="row" style="margin-top:20px;">
	                        	<div class="col-sm-10">
	                        		<div class="form-group {{$errors->has('event_date')? 'has-error':''}}">
	                        		    {!! Form::label('event_date', 'Date') !!}
	                        		    {!! Form::text('event_date', $event->event_date->format('Y-m-d'), ['class' => 'form-control', 'id' => 'event-date']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-2">
	                        		<div class="form-group {{$errors->has('emailable')? 'has-error':''}}">
	                        		    {!! Form::label('emailable', 'Email') !!}
	                        		    {!! Form::select('emailable', [1 => 'Yes', 0 => 'No'], null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('event_start_time')? 'has-error':''}}">
	                        		    {!! Form::label('event_start_time', 'Start Time') !!}
	                        		    {!! Form::text('event_start_time', null, ['class' => 'form-control time']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('event_end_time')? 'has-error':''}}">
	                        		    {!! Form::label('event_end_time', 'End Time') !!}
	                        		    {!! Form::text('event_end_time', null, ['class' => 'form-control time']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('event_type')? 'has-error':''}}">
	                        		    {!! Form::label('event_type', 'Type') !!}
	                        		    {!! Form::select('event_type', ['prepro' => 'Pre-Production', 'shoot' => 'Shoot', 'edit' => 'Edit'], null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('location')? 'has-error':''}}">
	                        		    {!! Form::label('location', 'Location') !!}
	                        		    {!! Form::select('location', ['station' => 'Station (Non Green Screen)', 'green-screen' => 'Green Screen', 'location' => 'On Location'], null, ['class' => 'form-control location']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row address" style="display: none;">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('address')? 'has-error':''}}">
	                        		    {!! Form::label('address', 'Address') !!}
	                        		    {!! Form::text('address', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('notes')? 'has-error':''}}">
	                        		    {!! Form::label('notes', 'Notes') !!}
	                        		    {!! Form::textarea('notes', null, ['class' => 'form-control', 'id' => 'trumbowyg']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
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
			$( "#event-date" ).dateDropper({format:'Y-m-d'});
			$( ".time" ).timeDropper({mousewheel:true,meridians:true,setCurrentTime:false});
			$.trumbowyg.svgPath = '/css/icons.svg';
			$('#trumbowyg').trumbowyg({
				btns: [
				        ['viewHTML'],
				        ['formatting'],
				        'btnGrp-semantic',
				        ['superscript', 'subscript'],
				        ['link'],
				        ['insertImage'],
				        'btnGrp-justify',
				        'btnGrp-lists',
				        // ['horizontalRule'],
				        ['removeformat'],
				        ['fullscreen']
				    ]
			});

			var location = $('.location'),
				address = $('.address');

			function showAddress(){
				location.val() == 'location' ? address.css('display', 'block') : address.css('display', 'none');
			}
			
			location.change(showAddress());
			setTimeOut(showAddress(), 0);
			// showAddress();

		})();
	</script>
@endsection
@section('scripts')
	@if(session()->has('message'))
		<script type="text/javascript">
			toastr.success('{!! session('message') !!}');
		</script>
	@endif
@endsection