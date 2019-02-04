<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;   
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;

abstract class AbstractRepository
{

	protected $all = [];
	protected $new = [];
	protected $dirty = [];
	protected $delete = [];
	protected $doa;
	protected $function;

	function __construct() 
	{
		$fact = AbstractPersistenceFactory::getFactory($this->targetClass());
		$this->doa = new DomainObjectAssembler($fact);
	}

	abstract public function buildDn (string $id) : string;

	abstract public function targetClass() : string;

	public function getObj(AbstractIdentityObject $id) : AbstractEntity
	{
		return $this->doa->findOne($id);
	}

	public function buildNew(DTO $dto) : void
	{
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

	protected function build(DTO $dto) : void
	{
		$obj = $this->doa->build($dto);
		$this->{$this->function}($obj);      //run AddNewDirtyDelete
	}

	protected function globalKey(string $unique) : string
	{
		$key = $unique;
		return $key;
	}
	//this is needed for a collection of objects to iterate.  (getFactory)
	private function getDoaFromObject(AbstractEntity $obj) : DomainObjectAssembler 
	{
		$class= get_class($obj);
		$factory = AbstractPersistenceFactory::getFactory($class);
		$doa = new DomainObjectAssembler($factory);
		return $doa;
	}

	protected function add(AbstractEntity $obj) : void
	{
		$uniqid = $obj->getUid();
		$this->all[$this->globalKey($uniqid)] = $obj;
	}

	public function findByDn(string $dn) : AbstractEntity
	{
		$uniqid = $dn;
		$key = $this->globalKey($uniqid);

		if (array_key_exists($key, $this->all)) {
			return $this->all[$key];
		}
	}

	public function findById(string $id) : AbstractEntity
	{
		$uniqid = $this->buildDn($id);
		return $this->findByDn($uniqid);
	}

	public function addNew(AbstractEntity $obj) : void
	{
		$uniqid = $obj->getUid();
		$key = $this->globalKey($uniqid);
		$this->new[$key] = $obj;
	}

	public function addDelete(AbstractEntity $obj) : void
	{
		$uniqid = $obj->getUid();
		$key = $this->globalKey($uniqid);
		$this->delete[$key] = $obj;
	}

	public function addDirty(AbstractEntity $obj) : void
	{
		$uniqid = $obj->getUid();
		$key = $this->globalKey($uniqid);
		if (! array_key_exists($key, $this->dirty)) {
			$this->dirty[$key] = $obj;
		}
	}

	public function performOperations() : bool
	{
		foreach ($this->dirty as $key => $obj) {
			$result[] = $this->getDoaFromObject($obj)->update($obj);
		}

		foreach ($this->new as $key => $obj) {
			$result[] = $this->getDoaFromObject($obj)->add($obj);
		}

		foreach ($this->delete as $key => $obj) {
			$result[] = $this->getDoaFromObject($obj)->delete($obj);
		}
		//reset
		$this->dirty = [];
		$this->new = [];
		$this->delete = [];

        return (!in_array(0, $result)) ? true : false;
	}
}
