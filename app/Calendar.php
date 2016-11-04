<?php

namespace App;

use Carbon\Carbon;
use App\SalesConnect\Helpers\Attributes\CalendarAttributes;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
	use CalendarAttributes;

    protected $fillable = [
    	'project_id', 'event_date', 'event_start_time',
    	'event_end_time', 'event_type', 'location',
    	'notes', 'duration_minutes', 'duration_hours',
    	'address'
    ];

    protected $dates = ['event_date', 'start_date_timestamp', 'end_date_timestamp', ];

    protected $appends = [
		'start_date_time_millisecond', 
		'end_date_time_millisecond', 
		'class_color',
		'start_date_time',
		'end_date_time',
		'start_date_timestamp',
		'end_date_timestamp'
	];

    //Relationships

    public function project(){
    	return $this->belongsTo(\App\Project::class);
    }
}
