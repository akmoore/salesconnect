<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    protected $fillable = [
    	'title', 'description', 'link',
    	'emailed', 'email_list', 'project_id'
    ];

    // Relationships
    public function project(){
    	return $this->belongsTo(\App\Project::class);
    }
}

