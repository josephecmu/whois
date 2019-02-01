<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory;

use cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\AbstractSelectionFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\ComputersSelectionFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\update\ComputersUpdateFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\ComputersCollection;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\AbstractCollection;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\ComputersDomainObjectFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\AbstractDomainObjectFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\ComputersMapper;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\dto\AbstractDTOFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\dto\ComputersDTOFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\modify\AbstractModifyFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\modify\ComputersModifyFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\ComputersRepository;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\AbstractRepository;

class ComputersPersistenceFactory extends AbstractPersistenceFactory
{

	public function getDomainObjectFactory(): AbstractDomainObjectFactory
	{
		return new ComputersDomainObjectFactory();		
	}

	public function getSelectionFactory() : AbstractSelectionFactory
	{
		return new ComputersSelectionFactory();
	}

	public function getCollection(array $raw) : AbstractCollection
	{
		return new ComputersCollection($raw);
	}

	public function getMapper(array $raw) : AbstractMapper
	{
		return new ComputersMapper($raw);
	}

	public function getModifyFactory() : AbstractModifyFactory 
	{
		return new ComputersModifyFactory($this);	//$this is needed to get the mapper inside the ComputersUpdateFactory
	}

	public function getDTOFactory () : AbstractDTOFactory
	{
		//return new ComputersDTOFactory($this); //$this is needed to get the mapper inside the ComputersDTOFactory
		return null;
	}

	public function getRepository () : AbstractRepository
	{
		return new ComputersRepository;
	}

}

