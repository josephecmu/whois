<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\PeopleRepository;

class AddPeopleService extends AbstractPeopleService

{

	public function execute(DTO $dto) : bool

	{

		$dto->unset('ou'); 							//this administrative key is not needed here.

		////some checking confirming the a userID does not already exist	
		//identity generator reference here??????
		//also check for existance of gidnumber and uidnumber and homedirectory

		$andrewid = $dto->get('andrewid');

		$dn = $this->repo->buildDn($andrewid);		//get the ID from the repo
		$dto->set('dn', $dn);						//we need to pass the $dn we just constructed
		$obj = $this->doa->build($dto);				//build the object

		$this->repo->addNew($obj);
		return $this->repo->performOperations();	

	}

}
