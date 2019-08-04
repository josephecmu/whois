<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\dto;

class ComputersDTOFactory extends AbstractDTOFactory
{
	protected function returnEntity() : string
	{
		return $this->options['computers']['entity'];
	}
}
