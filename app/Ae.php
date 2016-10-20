<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Ae extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'full_name'
            ]
        ];
    }

    protected $fillable = [
    	'manager_id', 'first_name','last_name',
    	'slug', 'work_phone', 'cell_phone',
    	'email'
    ];

    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }

    


    //Relationships

    public function clients(){
    	return $this->belongsToMany(\App\Client::class);
    }

    public function manager(){
    	return $this->belongsTo(\App\Manager::class);
    }
}

