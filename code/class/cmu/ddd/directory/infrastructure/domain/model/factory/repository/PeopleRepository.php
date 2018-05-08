<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\PeopleDn;
use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\factory\PeoplePersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;

class PeopleRepository extends AbstractRepository 
{


	public function buildDn(string $id) : string
	{
	
		return PeopleDn::buildDn($id);

	}

	public function remove() 
	{


	}

}
