<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class DeletePeopleService extends AbstractPeopleService 
{
	public function execute(DTO $dto) : bool
	{
		$this->repo->buildDelete($dto);
		return $this->repo->performOperations();	
	}
}
