<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
    	'project_id', 'primary', 'comments', 'title',
    	'emailable', 'has_been_emailed', 'recipients'
    ];

    //Relationships
    public function project(){
    	return $this->belongsTo(\App\Project::class);
    }
}
