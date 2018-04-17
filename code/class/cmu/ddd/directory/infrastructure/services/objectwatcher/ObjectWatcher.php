<?php

namespace cmu\ddd\directory\infrastructure\services\objectwatcher;

use cmu\ddd\directory\domain\model\lib\AbstractEntity;

class ObjectWatcher
{
	private $all = [];

	public function globalKey(AbstractEntity $obj): string
	{
			$key = $obj->getId();

			return $key;
	}

	public function add(AbstractEntity $obj)
	{
		$this->all[$this->globalKey($obj)] = $obj;
	}

	public function exists($classname, $id)
	{
		$inst = self::instance();
		$key = "{$classname} . {$id}";

		if (isset($inst->all[$key])) {
			return $inst->all[$key];
		}

		return null;
	}
}

