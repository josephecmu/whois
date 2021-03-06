<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\dto;

use cmu\ddd\directory\infrastructure\services\dto\DTOAssembler;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\share\TraitTargetClass;
use cmu\config\site\bin\TraitConfig;

abstract class AbstractDTOFactory
{
	use TraitConfig;

	protected $factory;
	protected $options;		//multi-array of parsed .ini file

	function __construct(AbstractPersistenceFactory $factory)
	{
		$this->options = $this->getConfigArray("config.ini");
		$this->factory = $factory;
	}

	public function getDTO(AbstractEntity $obj) : DTO
	{
		$raw = $this->object_to_array($obj); 
		$mapper = $this->factory->getMapper($raw);
		$data_array = $mapper->return_object_to_dto_array();
		return DTOAssembler::returnDTO($data_array, $this->returnEntity());
	}
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
