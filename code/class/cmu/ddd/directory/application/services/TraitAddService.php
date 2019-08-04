<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

trait TraitAddService
{
	public function execute(DTO $dto) : bool
	{
		$this->repo->buildNew($dto);
		return $this->repo->performOperations();	
	}
}
