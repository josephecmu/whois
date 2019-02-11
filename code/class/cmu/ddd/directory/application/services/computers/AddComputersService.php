<?php

namespace cmu\ddd\directory\application\services\computers;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class AddComputersService extends AbstractComputersService
{
	public function execute(DTO $dto) : bool
	{
		$this->repo->buildNew($dto);
		return $this->repo->performOperations();	
	}
}
