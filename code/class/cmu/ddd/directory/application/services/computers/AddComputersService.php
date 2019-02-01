<?php

namespace cmu\ddd\directory\application\services\computers;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\ComputersRepository;

class AddComputersService extends AbstractComputersService
{

	public function execute(DTO $dto) : bool
	{
		$dto->unset('ou'); 								//this administrative key is not needed here.

		$computerid = $dto->get('computerid');

		$dn = $this->repo->buildDn($computerid);		//get the ID from the repo
		$dto->set('dn', $dn);							//we need to pass the $dn we just constructed
		$obj = $this->doa->build($dto);					//build the object  --MOVE TO REPO?? 2-1-19

		$this->repo->addNew($obj);
		return $this->repo->performOperations();	
	}
}
