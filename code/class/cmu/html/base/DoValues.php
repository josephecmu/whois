<?php 
namespace cmu\html\base;

class DoValues extends AbstractValues 

{

	//3-22-18    value here must be an array
	//[values:protected] => Array
	//        (
	//     [firstname] => Array
	//     (
	//              [0] => Jack
	//     )                                                                   )
	public function setValues(array $values_in)
	{

		foreach ($values_in as $k => $v)

		{

			if (! is_array($v)) {
				$v = [$v] ;	
			}

			$this->values[$k] = $v;

		}

	}
	
}
