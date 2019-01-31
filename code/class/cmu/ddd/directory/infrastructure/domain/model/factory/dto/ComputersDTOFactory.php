<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\dto;

use \cmu\ddd\directory\domain\model\equipment\computers\Computer;

class ComputersDTOFactory extends AbstractDTOFactory
{

	protected function targetClass() : string
	{
		return Computer::class;
	}

	protected function returnEntity() : string
	{
		return 'computers';
	}
}
