<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = [
    	'project_id', 'event_date', 'event_start_time',
    	'event_end_time', 'event_type', 'location',
    	'notes', 'duration_minutes', 'duration_hours',
    	'address'
    ];

    protected $dates = ['event_date'];

    public function getConvertedEventStartTimeAttribute(){
    	$startTimeArray = explode(':', $this->event_start_time);
		$startTime = Carbon::createFromTime($startTimeArray[0], $startTimeArray[1], $startTimeArray[2]);
		return $startTime->format('g:i A');
    }

    public function getConvertedEventEndTimeAttribute(){
    	$endTimeArray = explode(':', $this->event_end_time);
		$endTime = Carbon::createFromTime($endTimeArray[0], $endTimeArray[1], $endTimeArray[2]);
		return $endTime->format('g:i A');
    }

    //Relationships

    public function project(){
    	return $this->belongsTo(\App\Project::class);
    }
}
