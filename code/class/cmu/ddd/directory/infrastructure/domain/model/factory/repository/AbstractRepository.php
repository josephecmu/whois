<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;   
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;
use cmu\ddd\directory\infrastructure\services\objectwatcher\ObjectWatcher;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\config\site\bin\TraitConfig;

abstract class AbstractRepository
{

	use TraitConfig;

	protected $function;
	protected $objwatcher;
	protected $doa;
	protected $fact;
	protected $options;

	function __construct() 
	{
		$this->options = $this->getConfigArray("config.ini");
		$this->fact = AbstractPersistenceFactory::getFactory($this->targetClass());
		$this->doa = new DomainObjectAssembler($this->fact);
		$this->objwatcher = ObjectWatcher::instance();
	}

	abstract public function targetClass() : string;

	abstract protected function getIdName() : string;

	public function getObj(AbstractIdentityObject $id) : AbstractEntity
	{
		$obj = $this->doa->findOne($id);
		$this->objwatcher::add($obj);
		return $obj;
	}

	public function buildNew(DTO $dto) : void
	{
		$dto->unset('ou'); 								//this service key is not needed here.

		$idname = $this->getIdName();
	
		$id = $dto->get($idname);
		$dn = $this->buildDn($id);						//get the ID from here
		$dto->set('dn', $dn);							//we need to pass the $dn we just constructed

		$this->function="addNew";
		$this->build($dto);
	}

	public function buildUpdate(DTO $dto) : void
	{
		$this->function="addDirty";
		$this->build($dto);
	}

	public function buildDelete(DTO $dto) : void
	{
		$this->function="addDelete";
		$this->build($dto);
	}

	public function buildDn(string $id) : string
	{
		$dnfact = $this->fact->getDn();
		return $dnfact->buildDn($id);
	}

	protected function build(DTO $dto) : void
	{
		$obj = $this->doa->build($dto);
		$this->objwatcher::{$this->function}($obj);
	}

	public function performOperations() : bool
	{
		return $this->objwatcher->performOperations();
	}
}
