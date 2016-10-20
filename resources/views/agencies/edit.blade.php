@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('agencies.index')}}">Agencies</a></li>
				  <li class="active">Edit</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Edit Agency</div>

	                <div class="panel-body">
	                    {!! Form::model($agency, ['route' => ['agencies.update', $agency->slug], 'method' => 'PUT']) !!}
	                        <div class="row">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('agency_name')? 'has-error':''}}">
	                        		    {!! Form::label('agency_name', 'Agency\'s Name') !!}
	                        		    {!! Form::text('agency_name', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        
	                        <div class="row" style="margin-top:20px;">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('contact_first_name')? 'has-error':''}}">
	                        		    {!! Form::label('contact_first_name', 'Contact\'s First Name') !!}
	                        		    {!! Form::text('contact_first_name', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('contact_last_name')? 'has-error':''}}">
	                        		    {!! Form::label('contact_last_name', 'Contact\'s Last Name') !!}
	                        		    {!! Form::text('contact_last_name', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        
	                        <div class="row">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('contact_phone')? 'has-error':''}}">
	                        		    {!! Form::label('contact_phone', 'Contact\'s Phone') !!}
	                        		    {!! Form::text('contact_phone', null, ['class' => 'form-control', 'data-mask' => '(000) 000-0000' ]) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('contact_email')? 'has-error':''}}">
	                        		    {!! Form::label('contact_email', 'Contact\'s Email') !!}
	                        		    {!! Form::email('contact_email', null, ['class' => 'form-control']) !!}
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