<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;

class AddpeopleService extends AbstractService 

{

	public function execute(DTO $dto) : bool

	{
		$ou_eq = $dto->get('ou');			//the DTO for 'ADD' contains the key 'ou'

		$dto->unset('ou'); 					//this administrative key is not needed here , but will be for ENTITY choice.

		$factory = AbstractPersistenceFactory::getFactory(People::class);	
		$doa = new DomainObjectAssembler($factory);

		////some checking confirming the a userID does not already exist	
		//identity generator reference here??????
		//also check for existance of gidnumber and uidnumber and homedirectory

		$andrewid = $dto->get('andrewid');

		echo "<pre>";
	
		//we need to create a proper RDN to insert.
		$peoplerdn = 'uid=' . $andrewid . ",ou=people,dc=mcs,dc=cmu,dc=edu";

		$dto->set('peoplerdn', $peoplerdn);

		$obj = $doa->build($dto);

		print_r($obj);

		return $doa->insert($obj);	

	}

}
