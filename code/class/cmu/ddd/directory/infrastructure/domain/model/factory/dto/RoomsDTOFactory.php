<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\dto;

use \cmu\ddd\directory\domain\model\locations\Rooms;

class RoomsDTOFactory extends AbstractDTOFactory
{

	protected function targetClass() : string
	{
	
		return Rooms::class;

	}

	protected function returnEntity() : string
	{
		return 'rooms';

	}
}

