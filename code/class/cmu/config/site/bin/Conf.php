<?php

namespace cmu\config\site\bin;
//class to hold the .ini values in object.  no business logic
//wrapper class

class Conf 
{
	private $vals = [];

	public function __construct(array $vals = [])
	{
		$this->vals = $vals;
	}

	public function get(string $key) //: string, array or null
	{
		return $this->vals[$key] ?? null;
	}

	public function set(string $key, $val) : void
	{
		$this->vals[$key] = $val;
	}
}

