<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Project extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
    	'client_id', 'user_id', 'manager_id', 'active',
    	'title', 'slug', 'length', 'start_date',
    	'end_date', 'air_date', 'c_number', 'isci',
    	'production_free', 'music_track', 'production_promotional',
    	'youtube_link', 'new_client'
    ];

    protected $dates = ['start_date', 'end_date', 'air_date'];

    // public function getAirDateAttribute($value){
    //     return  Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y');
    // }

    //Relationships
    public function client(){
    	return $this->belongsTo(\App\Client::class);
    }

    public function events(){
    	return $this->hasMany(\App\Calendar::class);
    }

    public function user(){
    	return $this->belongsTo(\App\User::class);
    }

    public function progress(){
    	return $this->hasOne(\App\Progress::class);
    }

    public function notes(){
    	return $this->hasMany(\App\Note::class);
    }

    public function order(){
    	return $this->hasOne(\App\Order::class);
    }

    public function plogs(){
        return $this->hasMany(\App\PLog::class);
    }
    
}
