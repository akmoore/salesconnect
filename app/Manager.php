<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use App\SalesConnect\Helpers\PhoneHelperTrait;

class Manager extends Model
{
	use Sluggable, PhoneHelperTrait;

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

    protected $appends = ['work_phone_callable', 'cell_phone_callable'];

    public function getWorkPhoneCallableAttribute(){
        return $this->transformPhoneNumber($this->work_phone);
    }

    public function getCellPhoneCallableAttribute(){
        return $this->transformPhoneNumber($this->cell_phone);
    }

    public function getFullNameAttribute(){
    	return $this->first_name . ' ' . $this->last_name;
    }

    //Relationships
    public function aes(){
    	return $this->hasMany(\App\Ae::class);
    }
}

