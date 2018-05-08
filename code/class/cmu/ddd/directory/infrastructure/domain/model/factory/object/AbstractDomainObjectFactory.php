<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity; 
use \cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;


abstract class AbstractDomainObjectFactory
{

		abstract public function createObject(array $norm_array);

		protected function getFactory($class) : array 
		{
			return AbstractPersistenceFactory::getFactory($class);	

		}

//		protected function getFromMap($class, $id)
//		{
//			return ObjectWatcher::exists($class, $id);
//		}
//
//		protected function addToMap(AbstractEntity $obj): AbstractEntity
//		{
//			return ObjectWatcher::add($obj);
//		}

}
