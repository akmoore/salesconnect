@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('projects.index')}}">Projects</a></li>
				  <li><a href="{{route('clients.show', $project->client->slug)}}">{{$project->client->company_name}}</a></li>
				  <li class="active">{{$project->title}}</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1" style="margin-bottom:20px;">
				<a href="{{route('projects.edit', $project->slug)}}" class="btn btn-default" style="margin-right:10px;">Edit Record</a>
				{!! Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'DELETE', 'class' => 'delete', 'style' => 'margin:0; padding:0;display:inline;']) !!}
					{{Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
				{!! Form::close() !!}
			</div>
		</div>

	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-1">
	            <div class="panel panel-primary">
	                <div class="panel-heading">
	                	<strong>{{$project->title}}</strong>
	                	<div class="btn-group pull-right" role="group">
	                		<button data-toggle="modal" data-target="#progressModal" class="btn btn-sm btn-default">
	                			Progress <span> | {{$project->progress->sum}}%</span>
	                		</button>
	                		<button data-toggle="modal" data-target="#youtubeModal" class="btn btn-sm btn-danger">
	                			YouTube
	                		</button>
	                		<a href="{{route('projects.orders.edit', [$project->slug, $project->order->id])}}" class="btn btn-sm btn-default">Order</a>
	                	</div>
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                    	<div class="col-sm-3 col-xs-4">
	                    		<p><strong>Client</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->client->company_name}}</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-4">
	                    		<p><strong>Account {{ str_plural('Executive', $project->client->aes->count()) }}</strong></p>
	                    		<p style="margin-top:-15px;">
	                    			@foreach($project->client->aes as $ae)
	                    				@if($loop->last)
	                    					{{$ae->full_name}}
	                    				@else
	                    					{{$ae->full_name}},
	                    				@endif
	                    			@endforeach
	                    		</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-4">
	                    		<p><strong>{{ str_plural('Manager', $project->client->aes->count()) }}</strong></p>
	                    		<p style="margin-top:-15px;">
	                    			@foreach($project->client->aes as $ae)
	                    				@if($loop->last)
	                    					{{$ae->manager->full_name}}
	                    				@else
	                    					{{$ae->manager->full_name}},
	                    				@endif
	                    			@endforeach
	                    		</p>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-sm-3 col-xs-3">
	                    		<p><strong>Active</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->active ? 'Yes' : 'No'}}</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-3">
	                    		<p><strong>Length</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->length}} secs</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-3">
	                    		<p><strong>Start Date</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->start_date->format('m/d/Y')}}</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-3">
	                    		<p><strong>End Date</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->end_date ? $project->end_date->format('m/d/Y') : 'Not Set'}}</p>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-sm-3 col-xs-3">
	                    		<p><strong>New Client</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->new_client ? 'Yes' : 'No'}}</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-3">
	                    		<p><strong>Free ?</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->production_free ? 'Yes' : 'No'}}</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-3">
	                    		<p><strong>Promo ?</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->production_promotional ? 'Yes' : 'No'}}</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-3">
	                    		<p><strong>Air Date</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->air_date ? $project->air_date->format('m/d/Y') : 'Not Set'}}</p>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-sm-3 col-xs-3">
	                    		<p><strong>Music Track</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->music_track ? $project->music_track : 'Not Set'}}</p>
	                    	</div>
	                    	<div class="col-sm-3 col-xs-3">
	                    		<p><strong>C Number</strong></p>
	                    		<p style="margin-top:-15px;">{{$project->c_number ? $project->c_number : 'Not Set'}}</p>
	                    	</div>
	                    	<div class="col-md-6 col-xs-12">
	                    		<p><strong>ISCI</strong></p>
	                    		<p style="margin-top:-15px;">
	                    			{{ucfirst(camel_case($project->title))}}_{{\Carbon\Carbon::now()->year}}_HD
	                    		</p>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading clearfix">Events <a href="{{route('projects.events.create', $project->slug)}}" class="btn btn-sm btn-default pull-right">New Event</a></div>
	                <div class="panel-body">
	                	@if($project->events->count())
	        		  		<div class="table-responsive" style="margin-top:10px;">
	    	    		    	<table class="table table-hover ">
	    	    		    	  	<thead>
	    		    		    	    <tr>
	    		    		    	    	<th>Type</th>
	    		    		    	    	<th>Date</th>
	    		    		    	    	<th>Start Time</th>
	    			    		    	    <th>End Time</th>
	    			    		    	    <th>Duration</th>
	    			    		    	    <th></th>
	    			    		    	    <th></th>
	    		    		    	    </tr>
	    		    		    	</thead>
	    		    		    	<tbody>
	    		    		    		@foreach($project->events as $key => $event)

    	    		    		    	    <tr>
    	    		    		    	    	<td>
    	    		    		    	    		<a href="#" data-event="{{$event}}" data-toggle="modal" data-target="#eventModal">
    	    		    		    	    			{{ucwords($event->event_type)}}
    	    		    		    	    		</a>
    	    		    		    	    	</td>
        		    		    	    		<td>{{$event->event_date->format('M d, Y')}}</td>
        		    		    	    		<td>{{$event->converted_event_start_time}}</td>
        		    		    	    		<td>{{$event->converted_event_end_time}}</td>
        		    		    	    		<td>{{$event->duration_hours}} hrs</td>
        		    		    	    		<td>
        		    		    	    			<a href="{{route('projects.events.edit', [$project->slug, $event->id])}}" class='btn btn-default btn-sm'>
        		    		    	    				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        		    		    	    			</a>
        		    		    	    		</td>
        		    		    	    		<td>
        		    		    	    			{!! Form::open(['route' => ['projects.events.destroy', $project->slug, $event->id], 'method' => 'DELETE', 'class' => 'delete', 'style' => 'margin:0; padding:0;display:inline;']) !!}
        		    		    	    				{{Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-default btn-sm'))}}
        		    		    	    			{!! Form::close() !!}
        		    		    	    		</td>
    	    		    		    	    </tr>
	    		    		    	    @endforeach
	    		    		    	</tbody>
	    	    		    	</table>
	        		  		</div>
	                	@else
	                		Currently, there are no Events.
	                	@endif
	                	
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading clearfix">Notes <a href="{{route('projects.notes.create', $project->slug)}}" class="btn btn-sm btn-default pull-right">New Note</a></div>
	                <div class="panel-body">
	                	@if($project->notes->count())
	        		  		<div class="table-responsive" style="margin-top:10px;">
	    	    		    	<table class="table table-hover ">
	    	    		    	  	<thead>
	    		    		    	    <tr>
	    		    		    	    	<th>Index</th>
	    		    		    	    	<th>Creation Date</th>
	    		    		    	    	<th>Title</th>
	    			    		    	    <th>Primary</th>
	    			    		    	    <th>Last Updated</th>
	    			    		    	    <th></th>
	    			    		    	    <th></th>
	    		    		    	    </tr>
	    		    		    	</thead>
	    		    		    	<tbody>
	    		    		    		@foreach($project->notes as $key => $note)
    	    		    		    	    <tr>
    	    		    		    	    	<td>{{++$key}}</td>
        		    		    	    		<td><a href="#" data-note="{{$note}}" data-toggle="modal" data-target="#myModal">{{$note->created_at->format('M d, Y')}}</a></td>
        		    		    	    		<td>{{$note->title ? $note->title : 'No Title'}}</td>
        		    		    	    		<td>{{$note->primary ? 'Yes' : 'No'}}</td>
        		    		    	    		<td>
        		    		    	    			@if($note->updated_at > $note->created_at)
        		    		    	    				<span class="glyphicon glyphicon-asterisk"></span>{{$note->updated_at->format('M d, Y')}}
        		    		    	    			@else
        		    		    	    				{{$note->updated_at->format('M d, Y')}}
        		    		    	    			@endif
        		    		    	    		</td>
        		    		    	    		<td>
        		    		    	    			<a href="{{route('projects.notes.edit', [$project->slug, $note->id])}}" class='btn btn-default btn-sm'>
        		    		    	    				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        		    		    	    			</a>
        		    		    	    		</td>
        		    		    	    		<td>
        		    		    	    			{!! Form::open(['route' => ['projects.notes.destroy', $project->slug, $note->id], 'method' => 'DELETE', 'class' => 'delete', 'style' => 'margin:0; padding:0;display:inline;']) !!}
        		    		    	    				{{Form::button('<i class="glyphicon glyphicon-remove"></i>', array('type' => 'submit', 'class' => 'btn btn-default btn-sm'))}}
        		    		    	    			{!! Form::close() !!}
        		    		    	    		</td>
    	    		    		    	    </tr>
	    		    		    	    @endforeach
	    		    		    	</tbody>
	    	    		    	</table>
	        		  		</div>
	        		  	@else
	        		  		<p>Currently, there are no Notes.</p>
        		  		@endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Modal title</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="col-sm-12 note-comments" style="margin-bottom: 50px;">
	      		<p>One fine body&hellip;</p>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" tabindex="-1" role="dialog" id="eventModal">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Modal title</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="col-sm-12 note-comments" style="margin-bottom: 50px;">
	      		<p>One fine body&hellip;</p>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" tabindex="-1" role="dialog" id="progressModal">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Progress</h4>
	      </div>
	      {!! Form::open(['route' => ['projects.progress.update', $project->slug, $project->progress->id], 'method' => 'PUT']) !!}
	      <div class="modal-body">
	      	<div class="col-sm-12 note-comments" style="margin-bottom: 50px;">
	      		{!! Form::hidden('project_id', $project->id) !!}
	      		<div class="row">
	      			<div class="col-md-3 col-sm-6 col-xs-12 form-group">
	      				{!! Form::checkbox('prepro_schedule', 1, $project->progress->prepro_schedule) !!}
	      				{!! Form::label('prepro_schedule', 'Pre Pro Scheduled?') !!}
	      			</div>
	      			<div class="col-md-3 col-sm-6 col-xs-12 form-group">
	      				{!! Form::checkbox('shoot_schedule', 1, $project->progress->shoot_schedule) !!}
	      				{!! Form::label('shoot_schedule', 'Shoot Scheduled?') !!}
	      			</div>
	      			<div class="col-md-3 col-sm-6 col-xs-12 form-group">
	      				{!! Form::checkbox('initial_edit_done', 1, $project->progress->initial_edit_done) !!}
	      				{!! Form::label('initial_edit_done', 'Initial Edit Done?') !!}
	      			</div>
	      			<div class="col-md-3 col-sm-6 col-xs-12 form-group">
	      				{!! Form::checkbox('first_revision', 1, $project->progress->first_revision) !!}
	      				{!! Form::label('first_revision', 'First Revision?') !!}
	      			</div>
	      		</div>
	      		<div class="row">
	      			<div class="col-md-3 col-sm-6 col-xs-12 form-group">
	      				{!! Form::checkbox('client_final_approval', 1, $project->progress->client_final_approval) !!}
	      				{!! Form::label('client_final_approval', 'Client\'s Final Approval?') !!}
	      			</div>
	      			<div class="col-md-3 col-sm-6 col-xs-12 form-group">
	      				{!! Form::checkbox('received_po', 1, $project->progress->received_po) !!}
	      				{!! Form::label('received_po', 'Received PO?') !!}
	      			</div>
	      			<div class="col-md-3 col-sm-6 col-xs-12 form-group">
	      				{!! Form::checkbox('upload_master_control', 1, $project->progress->upload_master_control) !!}
	      				{!! Form::label('upload_master_control', 'Upload to Master Control?') !!}
	      			</div>
	      			<div class="col-md-3 col-sm-6 col-xs-12 form-group">
	      				{!! Form::checkbox('upload_youtube', 1, $project->progress->upload_youtube) !!}
	      				{!! Form::label('upload_youtube', 'Upload to YouTube?') !!}
	      			</div>
	      		</div>
	      		<div class="row">
	      			<div class="col-md-3 col-sm-6 col-xs-12 form-group">
	      				{!! Form::checkbox('archived', 1, $project->progress->archived) !!}
	      				{!! Form::label('archived', 'Archived?') !!}
	      			</div>
	      			<div class="col-md-3 col-sm-6 col-xs-12 form-group">
	      				{!! Form::checkbox('aired', 1, $project->progress->aired) !!}
	      				{!! Form::label('aired', 'Aired?') !!}
	      			</div>
	      		</div>
	      		
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
	      </div>
	      {!! Form::close() !!}
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" tabindex="-1" role="dialog" id="youtubeModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Upload to YouTube</h4>
	      </div>
	      {!! Form::open(['route' => ['projects.youtube', $project->slug], 'files' => true]) !!}
	      <div class="modal-body">
	      	<div class="col-sm-12 note-comments" style="margin-bottom: 50px;">
	      		{!! Form::hidden('project_id', $project->id) !!}
	      		<div class="row">
	      			<div class="col-md-6 col-sm-6 col-xs-12 form-group">
	      				{!! Form::label('video', 'Choose a Video') !!}
	      				{!! Form::file('video', ['class' => 'dropzone']) !!}
	      			</div>
	      		</div>
	      		<div class="row">
	      			<div class="col-md-12 col-sm-6 col-xs-12 form-group">
	      				{!! Form::label('video_title', 'Title') !!}
	      				{!! Form::text('video_title', null, ['class' => 'form-control']) !!}
	      			</div>
	      		</div>
	      		<div class="row">
	      			<div class="col-md-12 col-sm-12 col-xs-12 form-group">
	      				{!! Form::label('description', 'Description') !!}
	      				{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
	      			</div>
	      		</div>
	      		
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
	      </div>
	      {!! Form::close() !!}
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script id="notesTpl" type="text/template">
		<p>@{{{comments}}}</p>
	</script>
	<script id="eventsTpl" type="text/template">
		<p>@{{{notes}}}</p>
	</script>

@endsection

@section('scripts')
	<script type="text/javascript" src="/js/dropzone.js"></script>
	<script type="text/javascript">
	    (function(){
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

	    	$('#myModal').on('show.bs.modal', function (event) {

	    		var item = $(event.relatedTarget);
	    		var data = item.data('note') || item.data('event');

	    		if(typeof data !== 'object'){
	    			data = {'comments': "Not an Object"};
	    		}

	    		var template = $('#notesTpl').html();;
	    		var html = Mustache.to_html(template, data);
	    		// console.log(decodeURI(data.comments));
				
				var modal = $(this);
				modal.find('.modal-title').text(data.title ? data.title : data.created_at);
				modal.find('.note-comments').html(html);

				console.log(data, data.id, data.primary, html);

			});

	    	$('#eventModal').on('show.bs.modal', function (event) {

	    		var $event = $(event.relatedTarget);
	    		var data = $event.data('event');
	    		var eventDate = moment(data.event_date).format('MMM D, YYYY'),
	    			eDate = data.event_date.substring(10,0),
	    			eventStartTime = moment(eDate + ' ' + data.event_start_time).format('h:mma'),
	    			eventEndTime = moment(eDate + ' ' + data.event_end_time).format('h:mma');

	    		// var	eDate = data.event_date.substring(10,0);

	    		// console.log(eventDate, eventStartTime, eventEndTime, eDate);

	    		if(typeof data !== 'object'){
	    			data = {'comments': "Not an Object"};
	    		}

	    		var template = $('#eventsTpl').html();;
	    		var html = Mustache.to_html(template, data);
	    		// console.log(decodeURI(data.comments));
				
				var modal = $(this);
				modal.find('.modal-title').text(eventDate + ': ' + eventStartTime + ' - ' + eventEndTime);
				modal.find('.note-comments').html(html);

				// console.log(data, data.id, data.primary, html);

			});

	    }());
	    

	</script>
@endsection