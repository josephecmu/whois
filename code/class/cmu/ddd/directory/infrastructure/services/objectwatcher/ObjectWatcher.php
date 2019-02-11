<?php

namespace cmu\ddd\directory\infrastructure\services\objectwatcher;

use cmu\ddd\directory\domain\model\lib\AbstractEntity;

class ObjectWatcher
{
	private static $all = [];
	private static $instance = null;

	public static function instance(): self
	{
		if (!isset(static::$instance)) {
			static::$instance = new ObjectWatcher;
		}
		return static::$instance;
	}

	public function idMapKey(AbstractEntity $obj): string
	{
		$key = $obj->getUid();
		return $key;
	}

	public static function add(AbstractEntity $obj) : void
	{
		$inst = static::instance();
		static::$all[$inst->idMapKey($obj)] = $obj;
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
}

