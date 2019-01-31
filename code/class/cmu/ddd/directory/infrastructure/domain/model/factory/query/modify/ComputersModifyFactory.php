<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\modify;

use \cmu\ddd\directory\domain\model\equipment\computers\Computer;
use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class ComputersModifyFactory extends AbstractModifyFactory

{
	//should be in parent    should rename to getDn   FU
	protected function getRdn(AbstractEntity $obj) : string
	{
		return $obj->dynGet("dn")->dynGet("dn");
	}

	protected function targetClass() : string
	{
		return Computer::class;
	}

}
