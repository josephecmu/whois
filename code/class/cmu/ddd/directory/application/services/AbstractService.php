<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;

abstract class AbstractService 
{
	protected $factory;	
	protected $repo;
	protected $idobj;

	function __construct()
	{
		$this->factory = AbstractPersistenceFactory::getFactory($this->targetClass());	
		$this->repo = $this->factory->getRepository(); 
		$this->idobj = $this->factory->getIdentityObject();
	}

	abstract function execute (DTO $dto);  //can return DTO(R), or can return bool (CUD)
	abstract function targetClass() : string;
}
