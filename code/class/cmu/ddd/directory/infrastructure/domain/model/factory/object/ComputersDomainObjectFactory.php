<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use \cmu\ddd\directory\domain\model\equipment\computers\Computer;
 
class ComputersDomainObjectFactory extends AbstractDomainObjectFactory
{

	public function createObject(array $norm_array) : Computer
	{
		return new Computer($norm_array);
	}

}
