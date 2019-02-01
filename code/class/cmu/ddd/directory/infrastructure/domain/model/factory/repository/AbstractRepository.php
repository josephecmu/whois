<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\factory\PeoplePersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\RoomsPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\ComputersPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;   
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\domain\model\equipment\computers\Computer;

abstract class AbstractRepository
{

	protected $all = [];
	protected $new = [];
	protected $dirty = [];
	protected $delete = [];

//	function __construct()
//	
//		$this->factory = AbstractPersistenceFactory::getFactory($this->targetClass());	
//		$this->doa = new DomainObjectAssembler($this->factory);
//		$this->repo = $this->factory->getRepository(); 
//
//	}

	abstract public function buildDn (string $id) : string;

	protected function globalKey(string $unique): string
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

	public function addNew(AbstractEntity $obj)
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
