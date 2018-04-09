<?php

namespace cmu\config\site\bin;
//class to hold the .ini values in object.  no business logic

class Conf 
{
	private $vals = [];

	public function __construct(array $vals = [])
	{
		$this->vals = $vals;
	}

	public function get(string $key)
	{
		
		return $this->vals[$key] ?? null;

	}

	public function set(string $key, $val)
	{
		$this->vals[$key] = $val;
	}
}

