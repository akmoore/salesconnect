<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PLog extends Model
{
    protected $fillable = ['project_id', 'log',];
    protected $table = 'plogs';
    protected $appends = ['converted_updated_at'];

   	public function getConvertedUpdatedAtAttribute(){
   		return $this->updated_at->format('M d, Y - g:ia');
   	}

    //Relationships
    public function project(){
    	return $this->belongsTo(\App\Project::class);
    }
}
