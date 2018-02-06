<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity; 

abstract class AbstractDomainObjectFactory
{

		protected function getFromMap($class, $id)
		{
			return ObjectWatcher::exists($class, $id);
		}

		protected function addToMap(DomainObject $obj): AbstractEntity
		{
			return ObjectWatcher::add($obj);
		}

		abstract public function createObject(array $array): AbstractEntity;

}
