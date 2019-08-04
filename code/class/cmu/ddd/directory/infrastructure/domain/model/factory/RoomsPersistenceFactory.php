<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory;

use cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\AbstractSelectionFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\RoomsSelectionFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\update\RoomsUpdateFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\RoomsCollection;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\AbstractCollection;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\RoomsDomainObjectFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\AbstractDomainObjectFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\RoomsMapper;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\dto\AbstractDTOFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\dto\RoomsDTOFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\modify\AbstractModifyFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\modify\RoomsModifyFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\RoomsRepository;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\AbstractRepository;
use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\idobject\RoomsIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\AbstractDn;
use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\RoomsDn;


class RoomsPersistenceFactory extends AbstractPersistenceFactory
{

	public function getDomainObjectFactory(): AbstractDomainObjectFactory
	{
		return new RoomsDomainObjectFactory();		
	}

	public function getSelectionFactory() : AbstractSelectionFactory
	{
		return new RoomsSelectionFactory();
	}

	public function getCollection(array $raw) : AbstractCollection
	{
		return new RoomsCollection($raw, $this->getDomainObjectFactory()) ;
	}

	public function getMapper(array $raw) : AbstractMapper
	{
		return new RoomsMapper($raw);
	}

	public function getModifyFactory() : AbstractModifyFactory 
	{
		return new RoomsModifyFactory($this);	//$this is needed to get the mapper inside the RoomsUpdateFactory
	}

	public function getDTOFactory () : AbstractDTOFactory
	{
		return new RoomsDTOFactory($this); //$this is needed to get the mapper inside the RoomsDTOFactory
	}

	public function getRepository () : AbstractRepository
	{
		return new RoomsRepository;
	}

	public function getIdentityObject() : AbstractIdentityObject
	{
		return new RoomsIdentityObject;
	}

	public function getDn() : AbstractDn
	{
		return new RoomsDn;
	}
}

