<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use App\SalesConnect\Helpers\PhoneHelperTrait;

class Agency extends Model
{
	use Sluggable, PhoneHelperTrait;

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

    protected $appends = ['contact_phone_callable'];

    public function getContactFullNameAttribute(){
    	return $this->contact_first_name . ' ' . $this->contact_last_name;
    }

    public function getContactPhoneCallableAttribute(){
        return $this->transformPhoneNumber($this->contact_phone);
    }

    //Relationships

    public function clients(){
    	return $this->hasMany(\App\Client::class);
    }
}
