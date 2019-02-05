<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class AddPeopleService extends AbstractPeopleService
{
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

		$andrewid = $dto->get('andrewid');

		$dn = $this->repo->buildDn($andrewid);		//get the ID from the repo
		$dto->set('dn', $dn);						//we need to pass the $dn we just constructed

		$this->repo->buildNew($dto);				

		return $this->repo->performOperations();	
	}
}
