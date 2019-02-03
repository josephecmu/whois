<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\collection;

use cmu\ddd\directory\infrastructure\domain\model\factory\object\AbstractDomainObjectFactory; 
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\share\TraitTargetClass;


abstract class AbstractCollection implements \Iterator

{

	use TraitTargetClass;

	protected $dofact = null;
	protected $total = 0;
	protected $raw = [];

	private $result;
	private $pointer = 0;
	private $objects = [];

	public function __construct(array $raw = [], AbstractDomainObjectFactory $dofact = null)
	{
		//changed 8-9 to support no DOA passed (for rooms(outlets))
//		if (count($raw) && ! is_null($dofact)) {
//			$this->raw = $raw;
//			$this->total = count($raw);
//		}

		$this->dofact = $dofact;
		$this->raw = $raw;

			
		$this->total = count($raw) ?: 0;

	}

	abstract public function targetClass(): string;

	 public function add(AbstractEntity $object)
	 {
		 $this->VerifyTargetClass($object);

		 $this->notifyAccess();
		 $this->objects[$this->total] = $object;
		 $this->total++;
		 
	}

	public function getTotal() : int
	{
		return $this->total;
	}

	protected function notifyAccess()
	{
		// deliberately left blank!
	}
	
	 private function getRow(int $num)
	 {
//		  $this->notifyAccess();
				 
		  if ($num >= $this->total || $num < 0) {
			  return null;
		  }
				 
		  if (isset($this->objects[$num])) {
			  return $this->objects[$num];
		  }

		  //This creates objects//////////	
		  if (isset($this->raw[$num])) {
			  $this->objects[$num] = $this->dofact->createObject($this->raw[$num]);
			  return $this->objects[$num];
		 }

	}

	public function rewind() : void
	{
		$this->pointer = 0;
	}

	public function current() : int
	{
		return $this->getRow($this->pointer);
	}

	public function key() : int
	{
		return $this->pointer;
	}

	public function next()
	{
		$row = $this->getRow($this->pointer);

		if ($row) {
			$this->pointer++;
		}

		return $row;
	}

	public function valid()
	{
		return (! is_null($this->current()));
	}

	////josephe 8-9 to return raw without creating object
	public function returnRawKey($key) : int
	{
		return $this->raw[$key];
	}

	public function returnRaw()  : array
	{
		return $this->raw;
	}

}
