<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use cmu\ddd\directory\domain\model\lib\AbstractEntity; 
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\services\objectwatcher\ObjectWatcher;
use cmu\config\site\bin\TraitConfig;

abstract class AbstractDomainObjectFactory
{

	use TraitConfig;

	protected $options;
	protected $idname;

	function __construct()
	{
		$this->options = $this->getConfigArray("config.ini");
		$this->idname = $this->getIdName();
 	}

	abstract protected function getIdName() : string;

	protected function getFromMap(string $classname, string $id) : ?object
	{
		return ObjectWatcher::exists($classname, $id);
	}

	protected function addToMap(AbstractEntity $obj) : void
	{
		ObjectWatcher::add($obj);
	}
}
