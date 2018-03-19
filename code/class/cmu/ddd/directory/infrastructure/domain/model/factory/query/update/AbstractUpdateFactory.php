<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\update;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity;
use \cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\share\TraitTargetClass;

abstract class AbstractUpdateFactory

{
	
	use TraitTargetClass;

	protected $factory;

	function __construct(AbstractPersistenceFactory $factory)
	{

		$this->factory = $factory;

	}

	abstract protected function getRdn($obj) : string;

	//CASTS to array
	protected function object_to_array(AbstractEntity $obj) : array
	{

		$this->verifyTargetClass($obj);

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

	public function newUpdate(AbstractEntity $obj) : array
	{

		$this->verifyTargetClass($obj);

		$rdn = $this->getRdn($obj);

		$raw = $this->object_to_array($obj);

		$mapper = $this->factory->getMapper($raw);

		$input = $mapper->return_object_to_ldaparray();

		return [$rdn, $input];

	}

}
