@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('projects.index')}}">Projects</a></li>
				  <li><a href="{{route('projects.show',$project->slug)}}">{{$project->title}}</a></li>
				  <li class="active">Edit Note</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-sm-8 col-sm-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Edit Note</div>

	                <div class="panel-body">
	                    
	                    {!! Form::model($note, ['route' => ['projects.notes.update', $project->slug, $note->id], 'method' => 'PUT']) !!}
	                    	{!! Form::hidden('project_id', $project->id) !!}
	                        <div class="row" style="margin-top:20px;">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('title')? 'has-error':''}}">
	                        		    {!! Form::label('title', 'Title of Note') !!}
	                        		    {!! Form::text('title', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('primary')? 'has-error':''}}">
	                        		    {!! Form::label('primary', 'Primary Note?') !!}
	                        		    {!! Form::select('primary', [0 => 'No', 1 => 'Yes'], null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('emailable')? 'has-error':''}}">
	                        		    {!! Form::label('emailable', 'Email Note?') !!}
	                        		    {!! Form::select('emailable', [0=>'No',1=>'Yes'], null, ['class' => 'form-control email-note']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row recipients" style="display: none;">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('recipients')? 'has-error':''}}">
	                        		    {!! Form::label('recipients', 'Recipients (Sent automatically to Client POC & AE)') !!}
	                        		    {!! Form::text('recipients', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('comments')? 'has-error':''}}">
	                        		    {!! Form::label('comments', 'Notes') !!}
	                        		    {!! Form::textarea('comments', null, ['class' => 'form-control', 'id' => 'trumbowyg']) !!}
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

			var emailNote = $('.email-note'),
				recipients = $('.recipients');
			
			emailNote.change(function(){
			    emailNote.val() != 0 ? recipients.css('display', 'block') : recipients.css('display', 'none');
			});
			
		})();

	</script>
@endsection
















