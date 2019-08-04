<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use cmu\ddd\directory\infrastructure\services\objectwatcher\ObjectWatcher;
use cmu\ddd\directory\domain\model\actors\people\People;

class PeopleDomainObjectFactory extends AbstractDomainObjectFactory
{

	protected function getIdName() : string
	{
		return $this->options['people']['idname'];
	}

	public function createObject(array $norm_array) : People
	{
		$classname = People::class;

		if (! $obj = $this->getFromMap($classname, $norm_array[$this->idname])) {
			$obj = new People($norm_array);
		}

		$this->addToMap($obj);

		return $obj;
	}
}
