<?php

namespace cmu\ddd\directory\application\services\computers;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\ComputersRepository;

class DeleteComputersService extends AbstractComputersService 

{
///must be mod for Computers ............................??
	public function execute(DTO $dto) : bool

	{

		/////////////////BUG, we can't pass andrewID in the form////////////////////////
//		$dn = $dto->get('dn');					//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

//		$andrewid = $this->getId($dn);			//the andrew id SHOULD be passed via the form (bug)

//		$dto->set('andrewid', $andrewid);
////////////////////////////////////////////////////////////////////////
		$this->repo->buildDelete($dto);

		return $this->repo->performOperations();	

	}

}
