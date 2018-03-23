<?php

namespace cmu\ddd\directory\infrastructure\services\dto;

class DTOAssembler

{
	
	public static function returnDTO(array $data) : DTO
	{

		return new DTO($data); 

	}

}
