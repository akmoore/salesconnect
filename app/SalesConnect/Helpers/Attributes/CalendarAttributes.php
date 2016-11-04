<?php

namespace App\SalesConnect\Helpers\Attributes;

use Carbon\Carbon;

trait CalendarAttributes {



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

	    public function getStartDateTimeMillisecondAttribute()
	    {
	        $dateArray = explode('-', $this->event_date);
	        $day = substr($dateArray[2], 0, 2);
	        $startTimeArray = explode(':', $this->event_start_time);
	        $dateTime = Carbon::create($dateArray[0], $dateArray[1], $day, $startTimeArray[0], $startTimeArray[1], $startTimeArray[2], 'America/Chicago');
	        return $dateTime->timestamp;
	    }

	    public function getEndDateTimeMillisecondAttribute()
	    {
	        $dateArray = explode('-', $this->event_date);
	        $day = substr($dateArray[2], 0, 2);
	        $endTimeArray = explode(':', $this->event_end_time);
	        $dateTime = Carbon::create($dateArray[0], $dateArray[1], $day, $endTimeArray[0], $endTimeArray[1], $endTimeArray[2], 'America/Chicago');
	        return $dateTime->timestamp;
	    }

	    public function getClassColorAttribute(){
	    	$color;
	    	if($this->event_type == 'prepro'){
	    		$color = '#4E9348';
	    	}elseif($this->event_type == 'shoot'){
	    		$color = '#0074C8';
	    	}else{
	    		$color = '#CA282E';
	    	}
	    	return $color;
	    }

	    public function getStartDateTimeAttribute(){
	    	return $this->event_date->format('Y-m-d') . 'T' . $this->event_start_time;
	    }

	    public function getEndDateTimeAttribute(){
	    	return $this->event_date->format('Y-m-d') . 'T' . $this->event_end_time;
	    }

	    public function getStartDateTimestampAttribute(){
	    	return $this->event_date->format('Y-m-d') . ' ' . $this->event_start_time;
	    }

	    public function getEndDateTimestampAttribute(){
	    	return $this->event_date->format('Y-m-d') . ' ' . $this->event_end_time;
	    }
}
















