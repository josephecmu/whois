<?php

namespace cmu\ddd\directory\domain\model\lib;

trait TraitDynamicSetterVerifyProperty

{

	use TraitDynSetGet, TraitValidator;

	private function flipArrayAndNull(array $array) : array

	{
		
		$array = array_flip($array); 
	
		$array = array_fill_keys(array_keys($array), null);

		return $array;

	}

	protected function confirmFieldsAndConfirmSetProperties ( array $fields, array $required_fields )

	{

		$flip = $this->flipArrayAndNull($required_fields);
		$merge = array_merge($flip, $fields);						//merge the keys of passed keys and required keys.

		foreach ($merge as $name => $value) {

			if (in_array($name, $required_fields)) {
				$this->isValid($name, $value, ["notNull"]); 	//check if required value is populated
			}

			if (!empty($value)) {
				$this->dynSet($name, $value);                             

			} 

		}

	}

}
 
