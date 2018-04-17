<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\factory\PeoplePersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\RoomsPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;   
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\domain\model\actors\locations\Rooms;
use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;

abstract class AbstractRepository
{

	protected $all = [];
	protected $new = [];
	protected $dirty = [];
	protected $delete = [];
	protected $doa;						//we need this for the initial root Entity build

	function __construct(DomainObjectAssembler $doa)
	{
		$this->doa = $doa;

	}

	abstract public function remove();

	abstract public function getDn(DTO $doa) : string;				//return the dn

	abstract protected function getIdObjectSearchById(string $id);

	private function globalKey(string $unique): string
	{

		$key = $unique;
		return $key;
	}

	private function getDoa(AbstractEntity $obj) : DomainObjectAssembler 
	{

		$class= get_class($obj);
		$factory = AbstractPersistenceFactory::getFactory($class);
		$doa = new DomainObjectAssembler($factory);
		return $doa;
	}

	protected function add(AbstractEntity $obj)
	{

		$dn = $obj->getUid();
		$this->all[$this->globalKey($dn)] = $obj;
	}

	public function findById($id) : AbstractEntity
	{

		$dn = $this->buildDn($id);

		if (array_key_exists($this->globalKey($dn), $this->all)) {
			return $this->all[$this->globalKey($dn)];
		}

		$idobj = $this->getIdObjectSearchById($id);

		return $this->doa->findOne($idobj);

	}

	public function addNew(DTO $dto)
	{

		$dn = $this->getDn($dto);		

		$dto->set('dn', $dn);		//we need to pass the $dn we just constructed

		$obj = $this->doa->build($dto);

		$dn = $obj->getUid();
		$this->new[$this->globalKey($dn)] = $obj;
	}

	public function performOperations() : bool
	{

		foreach ($this->dirty as $key => $obj) {
			$result[] = $this->getDoa($obj)->update($obj);

		}

		foreach ($this->new as $key => $obj) {
			$result[] = $this->getDoa($obj)->add($obj);
		}
		//reset
		$this->dirty = [];
		$this->new = [];

        return (!in_array(0, $result)) ? true : false;

	}

}
