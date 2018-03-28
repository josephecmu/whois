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

}
