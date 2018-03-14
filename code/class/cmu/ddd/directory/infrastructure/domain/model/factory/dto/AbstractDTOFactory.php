<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\dto;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;

abstract class AbstractDTOFactory
{

	protected $factory;
	protected $obj;

	function __construct(AbstractEntity $obj, AbstractPersistenceFactory $factory)
	{

		$this->factory = $factory;

		$this->obj = $obj;
	}

	abstract public function getDTO() : DTO;

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

}
