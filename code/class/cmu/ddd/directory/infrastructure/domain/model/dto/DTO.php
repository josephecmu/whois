<?php

namespace cmu\ddd\directory\infrastructure\domain\model\dto;

class DTO

{

	private $data_array = [];

	function __construct(array $array)
	{
	
		$this->data_array = $array;

	}

	public function get($key)
	{

		if (array_key_exists($key, $this->data_array)) {

			return $this->data_array[$key];
		
		}

		return null;

	}

	public function set($key, $value)
	{

		$this->data_array[$key] = $value;

	}

	public function getDataArray() : array
	{
		return $this->data_array;
	}

}
