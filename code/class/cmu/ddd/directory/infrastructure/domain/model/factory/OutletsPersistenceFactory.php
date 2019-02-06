<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory;

use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\idobject\OutletsIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\AbstractSelectionFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\OutletsSelectionFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\update\OutletsUpdateFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\OutletsCollection;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\AbstractCollection;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\AbstractDomainObjectFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\OutletsMapper;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\dto\AbstractDTOFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\dto\OutletsDTOFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\modify\AbstractModifyFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\modify\OutletsModifyFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\AbstractRepository;

class OutletsPersistenceFactory extends AbstractPersistenceFactory
{

	public function getSelectionFactory() : AbstractSelectionFactory
	{
		return new OutletsSelectionFactory();
	}

	public function getCollection(array $raw) : AbstractCollection
	{
		return new OutletsCollection($raw) ;
	}

	public function getMapper(array $raw) : AbstractMapper
	{
		return new OutletsMapper($raw);
	}

	public function getModifyFactory() : AbstractModifyFactory 
	{
		return new OutletsModifyFactory($this);	//$this is needed to get the mapper inside the OutletsUpdateFactory
	}

	public function getIdentityObject() : AbstractIdentityObject
	{
		return new OutletsIdentityObject;
	}
	
}

