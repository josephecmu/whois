<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\update;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity;
use \cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;

abstract class AbstractUpdateFactory

{
	protected $factory;

	function __construct(AbstractPersistenceFactory $factory)
	{

		$this->factory = $factory;

	}

	abstract public function newUpdate(AbstractEntity $obj): array;
	
	//CASTS to array
	protected function object_to_array(AbstractEntity $obj) : array
	{

		function obj_to_arr ($obj) {
			if(is_object($obj)) {
			   	$obj = (array) $obj;
			}	
			if(is_array($obj)) {
				$new = array();
				foreach($obj as $key => $val) {
					$new[$key] = obj_to_arr($val);   //recursive function
				}
			} else { 
				$new = $obj;
			}
			return $new; 
		};

		return obj_to_arr($obj);

	}
//	protected function buildStatement( array $obj_array) : array
//		}

}
