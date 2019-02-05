<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class UpdateRoomsservice extends AbstractRoomsService 
{
	public function execute(DTO $dto) : bool
	{
		$this->repo->buildUpdate($dto);  	//this should create subobjects and add them approp locations (add, dirty)
		return $this->repo->performOperations(); //run
	}
}	

