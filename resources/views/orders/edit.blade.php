@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<ol class="breadcrumb">
				  <li><a href="{{url('/home')}}">Dashboard</a></li>
				  <li><a href="{{route('projects.index')}}">Projects</a></li>
				  <li><a href="{{route('projects.show',$project->slug)}}">{{$project->title}}</a></li>
				  <li class="active">Edit Order</li>
				</ol>
			</div>
		</div>
	    <div class="row">
	        <div class="col-sm-8 col-sm-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Edit the P.O. <a href="{{route('projects.orders.pdf', [$project->slug, $order->id])}}" class="btn btn-sm btn-default pull-right">New Event</a></div>

	                <div class="panel-body">
	                    {!! Form::model($order, ['route' => ['projects.orders.update', $project->slug, $order->id], 'method'=>'PUT']) !!}
	                    	{!! Form::hidden('project_id', $project->id) !!}
	                        
	                        <div class="row">
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('stations')? 'has-error':''}}">
	                        		    {!! Form::label('stations', 'Stations') !!}
	                        		    {!! Form::select('stations', ['wvla' => 'WVLA (NBC 33)', 'wgmb' => 'WGBM (FOX 44)', 'wbrl' => 'WBRL (CW 21)'], null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('editor')? 'has-error':''}}">
	                        		    {!! Form::label('editor', 'Editor') !!}
	                        		    {!! Form::select('editor', ['ken' => 'Ken Moore', 'tiny' => 'Vincent Lagattuta'], null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-6">
	                        		<div class="form-group {{$errors->has('produced_by')? 'has-error':''}}">
	                        		    {!! Form::label('produced_by', 'Produced By') !!}
	                        		    {!! Form::text('produced_by', null, ['class' => 'form-control', 'id' => 'produced-by-date']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <br><br>

	                        <div class="row">
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('vcd_vhs')? 'has-error':''}}">
	                        		    {!! Form::label('vcd_vhs', 'VCD/VHS') !!}
	                        		    {!! Form::text('vcd_vhs', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('dvd')? 'has-error':''}}">
	                        		    {!! Form::label('dvd', 'DVD') !!}
	                        		    {!! Form::text('dvd', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('beta_dub')? 'has-error':''}}">
	                        		    {!! Form::label('beta_dub', 'Beta Dub') !!}
	                        		    {!! Form::text('beta_dub', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('crawl')? 'has-error':''}}">
	                        		    {!! Form::label('crawl', 'Crawl') !!}
	                        		    {!! Form::text('crawl', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('ftp')? 'has-error':''}}">
	                        		    {!! Form::label('ftp', 'FTP') !!}
	                        		    {!! Form::text('ftp', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('music_library')? 'has-error':''}}">
	                        		    {!! Form::label('music_library', 'Music Library') !!}
	                        		    {!! Form::text('music_library', null, ['class' => 'form-control']) !!}
	                        		</div>
	                        	</div>
	                        </div>

	                        <div class="row">
	                        	<div class="col-sm-4">
	                        		<div class="form-group {{$errors->has('discount')? 'has-error':''}}">
	                        		    {!! Form::label('discount', 'Discount') !!}
	                        		    {!! Form::text('discount', null, ['class' => 'form-control']) !!}
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

	
	<!-- 'location_time', 'edit_time', --> 
	<!-- 'vcd_vhs', 'dvd',
	'beta_dub', 'cwral', 
	'ftp', 'music_library', 'discount' -->

@endsection()

@section('scripts')
	<script type="text/javascript">
		(function(){
			$( "#produced-by-date" ).dateDropper({format:'Y-m-d'});
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