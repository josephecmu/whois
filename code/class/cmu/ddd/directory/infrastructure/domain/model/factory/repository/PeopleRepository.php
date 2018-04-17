<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\PeopleDn;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;

class PeopleRepository extends AbstractRepository 
{

	public function getDn(DTO $dto) : string
	{

		$andrewid = $dto->get('andrewid');

		$dn = $this->buildDn($andrewid);

		return $dn;
	}

	protected function buildDn(string $id) : string
	{
	
		return PeopleDn::buildDn($id);

	}

	protected function getIdObjectSearchById(string $id) : PeopleIdentityObject
	{

		$idobj = new PeopleIdentityObject();

		$idobj->field("uid")->eq($id);

		return $idobj;
	}

	public function remove() 
	{


	}

}
