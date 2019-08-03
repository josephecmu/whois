<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\application\services\TraitAddService;
//use cmu\ddd\directory\domain\model\equipment\computers\Computer;
//use cmu\ddd\directory\infrastructure\domain\model\factory\repository; 

class AddRoomsService extends AbstractRoomsService
{

//	use TraitAddService;

	public function execute(DTO $dto) : bool
	{

		//we need to check if the computer exists.
		//if ($dto->get('computers')) {
		//
		//
		//
		//}
		
		$this->repo->buildNew($dto);				

		return $this->repo->performOperations();	
	}
}

