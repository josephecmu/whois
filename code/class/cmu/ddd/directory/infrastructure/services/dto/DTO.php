<?php

namespace cmu\ddd\directory\infrastructure\services\dto;

class DTO

{

	private $data_array = [];

	function __construct(array $array)
	{
	
		$this->data_array = $array;

	}

	public function get($key)
	{

		return $this->data_array[$key] ?? null;

	}

	public function set($key, $value)
	{

		$this->data_array[$key] = $value;

	}

	public function getDataArray() : array
	{
		return $this->data_array;
	}

	public function unset(string $key)
	{
	
		unset($this->data_array[$key]);
		
	}

	public function seralize() : array
	{
		return json_encode($this->data_array);

	}
}
