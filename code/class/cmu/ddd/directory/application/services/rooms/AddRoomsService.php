<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class AddRoomsService extends AbstractRoomsService
{

	public function execute(DTO $dto) : bool
	{

		$this->repo->buildNew($dto);				

		return $this->repo->performOperations();	
	}
}

