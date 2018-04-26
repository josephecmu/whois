<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\PeopleRepository;

class UpdatePeopleservice extends AbstractPeopleService 
{

	public function execute(DTO $dto) : bool
	{

		//these lines should not be needed, we need to pass the andrewID via the form  BUG		
		$dn = $dto->get('dn');

		$id = $this->getId($dn);					//we need to set the 'id' (andrewid, etc) in the DTO.

		$dto->set('andrewid', $id);					//sets $id from above to Entity 'key' andrewid, etc.
		////////////////////////////////////////////////////////
		$obj = $this->doa->build($dto);

		$this->repo->addDirty($obj);

		return $this->repo->performOperations();	

	}

}	
