@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('aes.index')}}">Account Executives</a></li>
				  <li class="active">Create</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-sm-8 col-sm-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Create an Account Executive</div>

	                <div class="panel-body">
	                    {!! Form::open(['route' => 'aes.store']) !!}
	                        <div class="row">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('manager_id')? 'has-error':''}}">
	                        		    {!! Form::label('manager_id', 'Select Manager') !!}
	                        		    {!! Form::select('manager_id', $managers, null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        
	                        <div class="row" style="margin-top:20px;">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('first_name')? 'has-error':''}}">
	                        		    {!! Form::label('first_name', 'First Name') !!}
	                        		    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('last_name')? 'has-error':''}}">
	                        		    {!! Form::label('last_name', 'Last Name') !!}
	                        		    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        
	                        <div class="row">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('work_phone')? 'has-error':''}}">
	                        		    {!! Form::label('work_phone', 'Work Phone') !!}
	                        		    {!! Form::text('work_phone', null, ['class' => 'form-control', 'data-mask' => '(000) 000-0000' ]) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('cell_phone')? 'has-error':''}}">
	                        		    {!! Form::label('cell_phone', 'Cell Phone') !!}
	                        		    {!! Form::text('cell_phone', null, ['class' => 'form-control', 'data-mask' => '(000) 000-0000']) !!}
	                        		</div>
	                        	</div>
	                        </div>
	                        
	                        <div class="row">
	                        	<div class="col-sm-12">
	                        		<div class="form-group {{$errors->has('email')? 'has-error':''}}">
	                        		    {!! Form::label('email', 'Email') !!}
	                        		    {!! Form::email('email', null, ['class' => 'form-control']) !!}
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