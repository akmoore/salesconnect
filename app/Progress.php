<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $fillable = [
    	'prepro_schedule', 'shoot_schedule', 'initial_edit_done',
    	'first_revision', 'client_final_approval', 
    	'received_po', 'upload_master_control', 'upload_youtube', 
    	'archived', 'aired', 'sum', 'project_id'
    ];

    //Relationships
    public function project(){
    	return $this->belongsTo(\App\Project::class);
    }
}

