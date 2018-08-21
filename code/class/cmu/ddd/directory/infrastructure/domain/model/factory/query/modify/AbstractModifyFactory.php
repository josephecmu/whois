<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\modify;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity;
use \cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\share\TraitTargetClass;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;

abstract class AbstractModifyFactory

{
	
	use TraitTargetClass;

	protected $factory;

	function __construct(AbstractPersistenceFactory $factory)
	{

		$this->factory = $factory;

	}

	abstract protected function getRdn(AbstractEntity $obj) : string;

	//CASTS to array
	protected function object_to_array(AbstractEntity $obj) : array
	{

		$this->verifyTargetClass($obj);


		return $this->obj_to_arr($obj);

	}

	private function obj_to_arr($value)
	{

//		function obj_to_arr ($obj) {
			if(is_object($value)) {
			   	$value = (array) $value;
			}	
			if(is_array($value)) {
				$new = array();
				foreach($value as $key => $val) {
					$new[$key] = $this->obj_to_arr($val);   //recursive function
				}
			} else { 
				$new = $value;
			}
			return $new; 
//		};

	}


	protected function getModify(AbstractEntity $obj, string $mapperfunction) : array
	{

		$this->verifyTargetClass($obj);

		$rdn = $this->getRdn($obj);

		$raw = $this->object_to_array($obj);

		$mapper =  $this->factory->getMapper($raw);

		$input = $mapper->$mapperfunction();

		return [$rdn, $input];

	}

	public function newUpdate(AbstractEntity $obj) : array
	{

		return $this->getModify($obj, "return_object_to_ldaparray_update");

	}

	public function newAdd(AbstractEntity $obj) : array
	{

		return $this->getModify($obj, "return_object_to_ldaparray_add");

	}

	public function newDelete(AbstractEntity $obj) : string
	{

		return $this->getRdn($obj);

	}

}
