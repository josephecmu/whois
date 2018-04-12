<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\modify;

use \cmu\ddd\directory\domain\model\locations\Rooms;
use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class RoomsModifyFactory extends AbstractModifyFactory

{
	protected function getRdn(AbstractEntity $obj) : string

	{
		
		return $obj->dynGet("dn")->dynGet("dn");

	}

	protected function targetClass() : string
	{

		return Rooms::class;

	}

}

