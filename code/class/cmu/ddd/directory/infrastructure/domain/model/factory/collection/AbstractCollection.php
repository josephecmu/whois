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
		if (count($raw) && ! is_null($dofact)) {
			$this->raw = $raw;
			$this->total = count($raw);
		}

		$this->dofact = $dofact;
	}

	 public function add(AbstractEntity $object)
	 {
		 $this->VerifyTargetClass($object);

		 $this->notifyAccess();
		 $this->objects[$this->total] = $object;
		 $this->total++;
		 
	}

	abstract public function targetClass(): string;

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

	public function rewind()
	{
		$this->pointer = 0;
	}

	public function current()
	{
		return $this->getRow($this->pointer);
	}

	public function key()
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

}
