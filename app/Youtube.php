<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    protected $fillable = [
    	'title', 'description', 'link',
    	'emailed'
    ];

    // Relationships
    public function project(){
    	return $this->belongsTo(\App\Project::class);
    }
}

