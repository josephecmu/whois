<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\modify;

use cmu\ddd\directory\domain\model\equipment\outlets\Outlet; 
use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class OutletsModifyFactory extends AbstractModifyFactory

{
	protected function getRdn(AbstractEntity $obj) : string

	{
		
		return $obj->dynGet("dn")->dynGet("dn");

	}

	protected function targetClass() : string
	{

		return Outlet::class;

	}

}

