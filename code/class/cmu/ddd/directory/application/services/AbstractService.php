<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;

abstract class AbstractService 
{
	protected $doa;
	protected $factory;
	protected $repo;
	function __construct()
	{

		$this->factory = AbstractPersistenceFactory::getFactory($this->targetClass());	

		$this->doa = new DomainObjectAssembler($this->factory);

		$this->repo = $this->factory->getRepository(); 

	}

	abstract function execute (DTO $dto);  //can return DTO(R), or can return bool (CUD)
	abstract function targetClass() : string;

}
