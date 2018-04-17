<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\PeopleDn;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\PeopleRepository;

class AddPeopleService extends AbstractPeopleService

{

	public function execute(DTO $dto) : bool

	{
		$ou_eq = $dto->get('ou');			//the DTO for 'ADD' contains the key 'ou'

		$dto->unset('ou'); 					//this administrative key is not needed here.

		////some checking confirming the a userID does not already exist	
		//identity generator reference here??????
		//also check for existance of gidnumber and uidnumber and homedirectory

		$repo = new PeopleRepository($this->doa);
		$repo->addNew($dto);
		return $repo->performOperations();	

	}

}
