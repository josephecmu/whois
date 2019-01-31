<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\ComputersDn;
use cmu\ddd\directory\domain\model\actors\people\Computers;
use cmu\ddd\directory\infrastructure\domain\model\idobject\ComputersIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\factory\ComputersPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;

class ComputersRepository extends AbstractRepository 
{
	public function buildDn(string $id) : string
	{
		return ComputersDn::buildDn($id);
	}
}
