<?php
namespace App\SalesConnect\Helpers;

trait ExtractedListTrait {

	private function extractOriginal($object){
		$original = [];
		foreach ($object->getOriginal() as $column => $value) { 
		    $original[$column] = $value ;
		}

		return $original;

	}

	private function extractOriginalValues($originalData, $object){
		$orgCollection = collect($originalData);
		// return [is_array($object), is_object($object)]; 
		if(!is_array($object)){
			$newCollection = collect($object->getOriginal())->transform(function($item, $key){
				if(preg_match('/_date/', $key, $matches)){
					if(strlen($item) == 19){
						return substr($item, 0, 10);
					}
				}

				return $item;
			}); 
			// return [$orgCollection, $newCollection];
			$diff = $orgCollection->diff($newCollection)->toArray(); 
		}else{
			$objectArray = [];
			foreach ($object as $key => $value) {
				$objectArray[$key] = $value;
			}

			$diff = $orgCollection->diff($objectArray)->toArray();
		}
		
		$diffKey = array_keys($diff); 
		return implode(',', array_map('strtoupper', $diffKey));	
	}
}