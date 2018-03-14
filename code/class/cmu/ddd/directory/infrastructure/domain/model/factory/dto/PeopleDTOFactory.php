<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\dto;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;

class PeopleDTOFactory extends AbstractDTOFactory
{

	public function getDTO(AbstractEntity $obj) : DTO
	{

		$raw = $this->object_to_array($obj); 

		$mapper = $this->factory->getMapper($raw);

		$data_array = $mapper->return_object_to_dto_array();

		return new DTO($data_array);

	}

}
