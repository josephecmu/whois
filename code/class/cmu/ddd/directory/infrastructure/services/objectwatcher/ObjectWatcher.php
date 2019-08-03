<?php

namespace cmu\ddd\directory\infrastructure\services\objectwatcher;

use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;

class ObjectWatcher
{
	private $all = [];
	private $new = [];
	private $dirty = [];
	private $delete = [];
	private static $instance = null;

	public static function instance(): self
	{
		if (!isset(static::$instance)) {
			static::$instance = new ObjectWatcher;
		}
		return static::$instance;
	}

	public static function add(AbstractEntity $obj) : void
	{
		$inst = static::instance();
		$inst->all[$inst->globalKey($obj)] = $obj;
	}

	public static function exists($classname, $id) : ?object
	{
		$inst = static::instance();
		$key = "{$classname} . {$id}";

		if (isset($inst->all[$key])) {
			return $inst->all[$key];
		}
		return null;
	}
	protected function globalKey(AbstractEntity $obj) : string
	{
		$key = $obj->getUid();
		return $key;
	}
  
  	//this is needed for a collection of objects to iterate.  (getFactory)  performOperations()
	private static function getDoaFromObject(AbstractEntity $obj) : DomainObjectAssembler 
	{
		$class = get_class($obj);
		$factory = AbstractPersistenceFactory::getFactory($class);
		$doa = new DomainObjectAssembler($factory);
		return $doa;
	}

	public static function addNew(AbstractEntity $obj) : void
	{
		$inst = static::instance();
		$inst->new[$inst->globalKey($obj)] = $obj;
	}

	public static function addDelete(AbstractEntity $obj) : void
	{
		$inst = static::instance();
		$inst->delete[$inst->globalKey($obj)] = $obj;
	}

	public static function addDirty(AbstractEntity $obj) : void
	{
		$inst = static::instance();
		if (! array_key_exists($inst->globalKey($obj), $inst->new)) {
			$inst->dirty[$inst->globalKey($obj)] = $obj;
		}
	}

	 public static function addClean(AbstractEntity $obj) //: bool   untested, what does this return?
	 {
		 $inst  = static::instance();
		 unset($inst->delete[$inst->globalKey($obj)]);
		 unset($inst->dirty[$inst->globalKey($obj)]);
		 $inst->new = array_filter(
			 $inst->new,
			 function ($a) use ($obj) {
				 return !($a === $obj);
			 }
		 );
	 }		 

	public function performOperations() : bool
	{
		foreach ($this->dirty as $key => $obj) {
			$result[] = $this->getDoaFromObject($obj)->update($obj);
			echo "Updating...$key<br />";
		}

		foreach ($this->new as $key => $obj) {
			$result[] = $this->getDoaFromObject($obj)->add($obj);
			echo "Adding...$key<br />";
		}

		foreach ($this->delete as $key => $obj) {
			$result[] = $this->getDoaFromObject($obj)->delete($obj);
			echo "Deleting...$key<br />";
		}
		//reset
		$this->dirty = [];
		$this->new = [];
		$this->delete = [];

        	return (!in_array(0, $result)) ? true : false;
	}
}

