@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('clients.index')}}">Clients</a></li>
				  <li class="active">Create</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	                <div class="panel-heading">Create Client</div>

	                <div class="panel-body">
	                    {!! Form::model($client, ['route' => ['clients.update', $client->slug], 'method' => 'PUT']) !!}
	                    	<h5 style="margin-top:20px;" class="text-primary">Client</h5>
	                        <hr>
	                        <div class="row">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('ae_id')? 'has-error':''}}">
	                        		    {!! Form::label('aes_id', 'Account Executive(s)') !!}
	                        		    {!! Form::select('aes_id[]', $resources['aes'], $resources['myAes'], ['class' => 'form-control', 'multiple' => 'true']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('agency_id')? 'has-error':''}}">
	                        		    {!! Form::label('agency_id', 'Agency') !!}
	                        		    {!! Form::select('agency_id', $resources['agencies'], null, ['class' => 'form-control', 'placeholder' => '- Select if Applicable']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('company_name')? 'has-error':''}}">
	                        		    {!! Form::label('company_name', 'Client\'s Name') !!}
	                        		    {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        <div class="row">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('public_phone')? 'has-error':''}}">
	                        		    {!! Form::label('public_phone', 'Public Phone') !!}
	                        		    {!! Form::text('public_phone', null, ['class' => 'form-control', 'data-mask' => '(000) 000-0000']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('url')? 'has-error':''}}">
	                        		    {!! Form::label('url', 'Website') !!}
	                        		    {!! Form::text('url', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        <h5 style="margin-top:20px;" class="text-primary">Address</h5>
	                        <hr>
	                        <div class="row" style="margin-top:20px;">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('street')? 'has-error':''}}">
	                        		    {!! Form::label('street', 'Street Address') !!}
	                        		    {!! Form::text('street', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        <div class="row">
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('city')? 'has-error':''}}">
	                        		    {!! Form::label('city', 'City') !!}
	                        		    {!! Form::text('city', 'Baton Rouge', ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('state')? 'has-error':''}}">
	                        		    {!! Form::label('state', 'State') !!}
	                        		    {!! Form::text('state', 'Louisiana', ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('postal')? 'has-error':''}}">
	                        		    {!! Form::label('postal', 'Zip Code') !!}
	                        		    {!! Form::text('postal', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        <h5 style="margin-top:20px;" class="text-primary">Point of Contact</h5>
	                        <hr>
	                        <div class="row" style="margin-top:20px;">
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('primary_contact_first_name')? 'has-error':''}}">
	                        		    {!! Form::label('primary_contact_first_name', 'Contact\'s First Name') !!}
	                        		    {!! Form::text('primary_contact_first_name', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('primary_contact_last_name')? 'has-error':''}}">
	                        		    {!! Form::label('primary_contact_last_name', 'Contact\'s Last Name') !!}
	                        		    {!! Form::text('primary_contact_last_name', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('primary_contact_title')? 'has-error':''}}">
	                        		    {!! Form::label('primary_contact_title', 'Contact\'s Title (Role)') !!}
	                        		    {!! Form::text('primary_contact_title', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                      	</div>  
	                      	<div class="row">
                      			<div class="col-sm-6">
                      		  		<div class="form-group {{$errors->has('primary_contact_phone')? 'has-error':''}}">
                      		  		    {!! Form::label('primary_contact_phone', 'Contact\'s Phone') !!}
                      		  		    {!! Form::text('primary_contact_phone', null, ['class' => 'form-control', 'data-mask' => '(000) 000-0000' ]) !!}
                      		  		</div>
                      		  	</div>
                      		  	<div class="col-sm-6">
                      		  		<div class="form-group {{$errors->has('primary_contact_email')? 'has-error':''}}">
                      		  		    {!! Form::label('primary_contact_email', 'Contact\'s Email') !!}
                      		  		    {!! Form::email('primary_contact_email', null, ['class' => 'form-control']) !!}
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