<?php

namespace cmu\ddd\directory\application\services\computers;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\ComputersRepository;

class AddComputersService extends AbstractComputersService

{
///this must be modified for computers..........................1-31-19
	public function execute(DTO $dto) : bool

	{
		// FU  we can remove this in mapper and not clutter Services??????????????????
		// mapper works on ARRAYS, DTO is already an object
		// special DTO that calls  mapper???
		// maybe:
		//$mapper = $this->factory->getMapper($dto->getDataArray());
		//$dto = new DTO($mapper->return_dto_to_domain_array());
		//
		$dto->unset('ou'); 							//this administrative key is not needed here.

		////some checking confirming the a userID does not already exist	
		//identity generator reference here??????
		//also check for existance of gidnumber and uidnumber and homedirectory

		$computerid = $dto->get('computerid');

		$dn = $this->repo->buildDn($computerid);		//get the ID from the repo
		$dto->set('dn', $dn);						//we need to pass the $dn we just constructed
		$obj = $this->doa->build($dto);				//build the object

		$this->repo->addNew($obj);
		return $this->repo->performOperations();	

	}

}
