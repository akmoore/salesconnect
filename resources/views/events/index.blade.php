@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/fullcalendar.min.css">
@endsection

@section('scripts')
	<script type="text/javascript" src="/js/fullcalendar.min.js"></script>
	<script type="text/javascript">
		 $('#calendar').fullCalendar({
		 	header: {
		 		left: 'prev,next today',
		 		center: 'title',
		 		right: 'month,agendaWeek,agendaDay,listWeek'
		 	},
		 	navLinks: true, // can click day/week names to navigate views
		 	editable: false,
		 	eventLimit: true, // allow "more" link when too many events
		 	events: {!! $events !!}
		 });
    </script>
@endsection

@section('content')
	<div class="container" style="margin-bottom: 30px;">
		<div class="col-sm-12">
			<div id='calendar'></div>
		</div>
	</div>
@endsection
