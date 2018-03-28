<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\modify;

use \cmu\ddd\directory\domain\model\actors\people\People;
use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class PeopleModifyFactory extends AbstractModifyFactory

{
	protected function getRdn(AbstractEntity $obj) : string

	{
		
		return $obj->dynGet("dn")->dynGet("dn");

	}

	protected function targetClass() : string
	{

		return People::class;

	}

}
