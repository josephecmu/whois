<?php

namespace cmu\ddd\directory\infrastructure\services\dto;

class DTOAssembler

{
	
	public static function returnDTO(array $data, string $entity = null) : DTO
	{

		switch ($entity) {

//			case 'people';
//				$dto = PeopleDTO::class;
//				break;
			case 'rooms';
				$dto = RoomsDTO::class;
				break;
			default;					//may be null
				$dto = DTO::class;
		}	

		return new $dto($data); 

	}

}
