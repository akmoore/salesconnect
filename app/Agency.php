<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Agency extends Model
{
	use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'agency_name'
            ]
        ];
    }

    protected $fillable = [
    	'agency_name', 'slug', 'contact_first_name',
    	'contact_last_name', 'contact_email',
    	'contact_phone'
    ];

    public function getContactFullNameAttribute(){
    	return $this->contact_first_name . ' ' . $this->contact_last_name;
    }

    //Relationships

    public function clients(){
    	return $this->hasMany(\App\Client::class);
    }
}
