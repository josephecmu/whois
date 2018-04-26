<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\PeopleDn;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\PeoplePersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;

class PeopleRepository extends AbstractRepository 
{

	protected function getRootDoa() : DomainObjectAssembler
	{

		return new DomainObjectAssembler(new PeoplePersistenceFactory);

	}

	public function buildDn(string $id) : string
	{
	
		return PeopleDn::buildDn($id);

	}

	protected function getIdObjectSearchById(string $id) : PeopleIdentityObject
	{

		$idobj = new PeopleIdentityObject();
			
		$idobj->field("uid")->eq($id);

		return $idobj;
	}

	protected function getDomainKey() : string
	{

		
	  	return "andrewid";

	}

	public function remove() 
	{


	}

}
