<?php

namespace cmu\ddd\directory\application\services\computers;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class DeleteComputersService extends AbstractComputersService 
{
	public function execute(DTO $dto) : bool
	{
		$this->repo->buildDelete($dto);
		return $this->repo->performOperations();	
	}
}
