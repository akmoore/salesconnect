<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use App\SalesConnect\Helpers\PhoneHelperTrait;

class Ae extends Model
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
    	'manager_id', 'first_name','last_name',
    	'slug', 'work_phone', 'cell_phone',
    	'email'
    ];

    protected $appends = ['work_phone_callable', 'cell_phone_callable'];

    //Setting Attributes
    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }

    public function getWorkPhoneCallableAttribute(){
        return $this->transformPhoneNumber($this->work_phone);
    }

    public function getCellPhoneCallableAttribute(){
        return $this->transformPhoneNumber($this->cell_phone);
    }


    //Relationships

    public function clients(){
    	return $this->belongsToMany(\App\Client::class);
    }

    public function manager(){
    	return $this->belongsTo(\App\Manager::class);
    }


    //Transformation

    // public function transformPhoneNumber($phone){
    //     $phoneExplode_Whole = explode(' ', $phone);
    //     return $phoneExplode_Front_Parentheses_1 = substr($phoneExplode_Whole[0], 0,3);
    // }
}

