<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class UpdatePeopleservice extends AbstractPeopleService 
{
	public function execute(DTO $dto) : bool
	{
		$this->repo->buildUpdate($dto);
		return $this->repo->performOperations();	
	}
}	
