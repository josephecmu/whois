<?php

namespace cmu\ddd\directory\infrastructure\services\dto;

class DTOAssembler

{

	private $data;

	function __construct(array $data)
	{

		$this->data=$data;

	}
	
	public function returnDTO() : DTO
	{

		return new DTO($this->data); 

	}



}
