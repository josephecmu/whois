<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper;

use cmu\config\site\bin\Conf;

class RoomsMapper extends AbstractMapper
{

	protected function returnConcreteConfigObject(array $options) : Conf
	{	
		return $this->returnConfigObject($options['rooms']) ;

	}	

}

