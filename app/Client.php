<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

use App\SalesConnect\Helpers\PhoneHelperTrait;

class Client extends Model
{
    use Sluggable, SoftDeletes, PhoneHelperTrait;

    protected $dates = ['deleted_at'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'company_name'
            ]
        ];
    }

    protected $fillable = [
    	'agency_id', 'company_name','slug', 'primary_contact_first_name',
    	'primary_contact_last_name', 'primary_contact_phone',
    	'primary_contact_email', 'street', 'city', 'state', 'postal',
    	'public_phone', 'url', 'primary_contact_title'
    ];

    protected $appends = ['primary_contact_phone_callable', 'public_phone_callable'];

    public function getContactFullNameAttribute(){
        return $this->primary_contact_first_name . ' ' . $this->primary_contact_last_name;
    }

    public function getPrimaryContactPhoneCallableAttribute(){
        return $this->transformPhoneNumber($this->primary_contact_phone);
    }

    public function getPublicPhoneCallableAttribute(){
        return $this->transformPhoneNumber($this->public_phone);
    }

    //Relationships

    public function aes(){
    	return $this->belongsToMany(\App\Ae::class);
    }

    public function agency(){
    	return $this->belongsTo(\App\Agency::class);
    }

    public function projects(){
    	return $this->hasMany(\App\Project::class);
    }
}

