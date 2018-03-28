<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory;

use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\AbstractDomainObjectFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\AbstractCollection;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\AbstractSelectionFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\read\AbstractReadFactory;
#use cmu\ddd\directory\infrastructure\domain\model\factory\query\update\AbstractUpdateFactory;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\dto\AbstractDTOFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\modify\AbstractModifyFactory;
abstract class AbstractPersistenceFactory

{
	//if we don't want to force return type, children can force Object return of Concrete type
	abstract public function getDomainObjectFactory(): AbstractDomainObjectFactory;
 	abstract public function getMapper(array $raw): AbstractMapper;
	abstract public function getCollection(array $raw): AbstractCollection;
	abstract public function getSelectionFactory(): AbstractSelectionFactory;
	abstract public function getModifyFactory(): AbstractModifyFactory;
//	abstract public function getAddFactory():  AbstractModifyFactory;
//nothing special at this point about DTO at this point any Entity could use, ...delete??  but may expand DTO.
	abstract public function getDTOFactory(): AbstractDTOFactory;			
	public static function getFactory($target_class) : AbstractPersistenceFactory
	
	{

		switch ($target_class) {
			case People::class:
				return new PeoplePersistenceFactory();
				break;
			case Rooms::class:
				return new RoomsPersistenceFactory();
				break;
			default: 
				echo "no class found";

		}
	}
}
