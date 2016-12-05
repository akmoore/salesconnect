@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('projects.index')}}">Projects</a></li>
				  <li class="active">Create</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-sm-10 col-sm-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Create a Project</div>

	                <div class="panel-body">
	                    {!! Form::open(['route' => 'projects.store']) !!}
	                        <div class="row">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('client_id')? 'has-error':''}}">
	                        		    {!! Form::label('client_id', 'Select Client') !!}
	                        		    {!! Form::select('client_id', $resources['clients'], $client, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('campaign')? 'has-error':''}}">
	                        		    {!! Form::label('campaign_id', 'Select Campaign') !!}
    	                        		<div class="input-group">
                            		      	{!! Form::select('campaign_id', $resources['campaigns'], $client, ['class' => 'form-control', 'placeholder' => '- Choose Campaign']) !!}
                            		      	<span class="input-group-btn">
                            		        	<button 
                            		        		class="btn btn-default glyphicon glyphicon-edit" 
                            		        		type="button" 
                            		        		data-toggle="modal" 
                            		        		data-target="#campaignModal" ></button>
                            		      	</span>
                            		    </div><!-- /input-group -->
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
	                        		    {!! Form::text('air_date', null, ['class' => 'form-control', 'id' => 'air-date']) !!}
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

	<!-- MODAL FOR YOU-TUBE -->
	<div class="modal fade" tabindex="-1" role="dialog" id="campaignModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Create New Campaign</h4>
	      </div>
	      {!! Form::open(['route' => 'campaigns.store']) !!}
	      <div class="modal-body">
	      	<div class="col-sm-12 note-comments" style="margin-bottom: 50px;">
	      		<div class="row">
	      			<div class="col-md-12 col-sm-12 col-xs-12 form-group">
	      				{!! Form::label('display_name', 'Campaign\'s Name') !!}
	      				{!! Form::text('display_name', null, ['class' => 'form-control']) !!}
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

@endsection()

@section('scripts')
	<script type="text/javascript">
		(function(){
			$( "#air-date" ).dateDropper();

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
		})();
	</script>
@endsection