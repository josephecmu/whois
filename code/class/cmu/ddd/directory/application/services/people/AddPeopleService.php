<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class AddPeopleService extends AbstractPeopleService

{

	public function execute(DTO $dto) : bool

	{
		$ou_eq = $dto->get('ou');			//the DTO for 'ADD' contains the key 'ou'

		$dto->unset('ou'); 					//this administrative key is not needed here.

		////some checking confirming the a userID does not already exist	
		//identity generator reference here??????
		//also check for existance of gidnumber and uidnumber and homedirectory

		$andrewid = $dto->get('andrewid');

		//we need to create a proper RDN to insert.
		$dn = 'uid=' . $andrewid . ",ou=people,dc=mcs,dc=cmu,dc=edu";

		$dto->set('dn', $dn);

		$obj = $this->doa->build($dto);

		return $this->doa->add($obj);	

	}

}
