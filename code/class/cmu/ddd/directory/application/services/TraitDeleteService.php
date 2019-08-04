<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

trait TraitDeleteService
{
	public function execute(DTO $dto) : bool
	{
		$this->repo->buildDelete($dto);
		return $this->repo->performOperations();	
	}
}
