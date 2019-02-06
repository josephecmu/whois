<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\dto;

class PeopleDTOFactory extends AbstractDTOFactory
{
	protected function returnEntity() : string
	{
		return 'people';
	}
}
