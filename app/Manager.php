<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Manager extends Model
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
    	'first_name', 'last_name', 'work_phone',
    	'cell_phone', 'email', 'slug', 'team'
    ];

    public function getFullNameAttribute(){
    	return $this->first_name . ' ' . $this->last_name;
    }

    //Relationships
    public function aes(){
    	return $this->hasMany(\App\Ae::class);
    }
}

