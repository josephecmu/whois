<?php

namespace cmu\ddd\directory\application\services\computers;

use cmu\ddd\directory\application\services\TraitAddService;


class AddComputersService extends AbstractComputersService
{

	use TraitAddService;

//	public function execute(DTO $dto) : bool
//	{
//		$this->repo->buildNew($dto);
//		return $this->repo->performOperations();	
//	}
}
