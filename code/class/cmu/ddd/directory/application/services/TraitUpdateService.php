<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

trait TraitUpdateService
{
	public function execute(DTO $dto) : bool
	{
		$this->repo->buildUpdate($dto);
		return $this->repo->performOperations();	
	}
}	
