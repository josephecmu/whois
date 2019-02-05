<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\dto;

use \cmu\ddd\directory\domain\model\actors\people\People;

class PeopleDTOFactory extends AbstractDTOFactory
{
	protected function targetClass() : string
	{
		return People::class;
	}

	protected function returnEntity() : string
	{
		return 'people';
	}
}
