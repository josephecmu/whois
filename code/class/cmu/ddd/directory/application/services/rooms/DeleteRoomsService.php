<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\RoomsRepository;

class DeleteRoomsService extends AbstractRoomsService 
{

	public function execute(DTO $dto) : bool
	{
		$this->repo->buildDelete($dto);
		return $this->repo->performOperations();	

	}
}

