<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory;

use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\domain\model\locations\Rooms;
use cmu\ddd\directory\domain\model\equipment\computers\Computer;
use cmu\ddd\directory\domain\model\equipment\outlets\Outlet;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\AbstractDomainObjectFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\AbstractCollection;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\AbstractSelectionFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\read\AbstractReadFactory;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\dto\AbstractDTOFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\query\modify\AbstractModifyFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\AbstractRepository;

abstract class AbstractPersistenceFactory

{
	//if we don't want to force return type, children can force Object return of Concrete type
//	abstract public function getDomainObjectFactory(): AbstractDomainObjectFactory;
 	abstract public function getMapper(array $raw): AbstractMapper;
	abstract public function getCollection(array $raw): AbstractCollection;
	abstract public function getSelectionFactory(): AbstractSelectionFactory;
	abstract public function getModifyFactory(): AbstractModifyFactory;
//	abstract public function getRepository() : AbstractRepository;
////nothing special at this point about DTO at this point any Entity could use, ...delete??  but may expand DTO.
//	abstract public function getDTOFactory(): AbstractDTOFactory;			
//
	public static function getFactory($target_class) : AbstractPersistenceFactory
	{
		switch ($target_class) {
			case People::class:
				return new PeoplePersistenceFactory();
				break;
			case Rooms::class:
				return new RoomsPersistenceFactory();
				break;
			case Outlet::class;
				return new OutletsPersistenceFactory();
				break;
			case Computer::class;
				return new ComputersPersistenceFactory();
				break;
			default: 
				echo "no class found " . $target_class ." in AbstractPersistenceFactory";

		}
	}
}
