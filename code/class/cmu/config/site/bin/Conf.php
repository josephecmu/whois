<?php

namespace cmu\config\site\bin;
//class to hold the .ini values in object.  no business logic
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\config\InterfaceConfig;

class Conf 
{
	private $vals = [];

	public function __construct(array $vals = [])
	{
		$this->vals = $vals;
	}

	public function get(string $key)
	{
		if (isset($this->vals[$key])) {
			return $this->vals[$key];
		}
		return null;
	}

	public function set(string $key, $val)
	{
		$this->vals[$key] = $val;
	}
}

