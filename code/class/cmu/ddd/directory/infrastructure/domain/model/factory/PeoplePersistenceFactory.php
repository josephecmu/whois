<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory;

use cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\AbstractSelectionFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\PeopleSelectionFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\update\PeopleUpdateFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\PeopleCollection;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\AbstractCollection;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\PeopleDomainObjectFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\AbstractDomainObjectFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\PeopleMapper;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\dto\AbstractDTOFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\dto\PeopleDTOFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\modify\AbstractModifyFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\modify\PeopleModifyFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\PeopleRepository;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\AbstractRepository;
use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;

class PeoplePersistenceFactory extends AbstractPersistenceFactory
{

	public function getDomainObjectFactory(): AbstractDomainObjectFactory
	{
		return new PeopleDomainObjectFactory();		
	}

	public function getSelectionFactory() : AbstractSelectionFactory
	{
		return new PeopleSelectionFactory();
	}

	public function getCollection(array $raw) : AbstractCollection
	{
		return new PeopleCollection($raw, $this->getDomainObjectFactory()) ;
	}

	public function getMapper(array $raw) : AbstractMapper
	{
		return new PeopleMapper($raw);
	}

	public function getModifyFactory() : AbstractModifyFactory 
	
	{
		return new PeopleModifyFactory($this);	//$this is needed to get the mapper inside the PeopleUpdateFactory
	}

	public function getDTOFactory () : AbstractDTOFactory
	{
		return new PeopleDTOFactory($this); //$this is needed to get the mapper inside the PeopleDTOFactory
	}

	public function getRepository() : AbstractRepository  
	{
		return new PeopleRepository;
	}

	public function getIdentityObject() : AbstractIdentityObject
	{
		return new PeopleIdentityObject;
	}
}
