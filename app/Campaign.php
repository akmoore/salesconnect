<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
    	'display_name', 'ccode'
    ];


    //Relationship
    public function projects(){
    	return $this->hasMany(\App\Project::class);
    }
}
