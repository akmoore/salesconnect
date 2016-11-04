<?php

namespace App\SalesConnect\Helpers;

trait PhoneHelperTrait {

	public function transformPhoneNumber($phone){
	    $phoneWithAreaCode = explode(' ', $phone);
	    $phoneLocal = explode('-', $phoneWithAreaCode[1]);
	    $areaCode = substr($phoneWithAreaCode[0], 1,3);
	    return $callableNumber = '+1' . $areaCode . $phoneLocal[0] . $phoneLocal[1];
	}
	
}