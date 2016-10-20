<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
    	'name', 'display_name'
    ];

    //Relationship
    public function users(){
    	return $this->belongsToMany(\App\User::class);
    }
}
