<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

use cmu\ddd\directory\infrastructure\domain\model\idobject\ComputersIdentityObject;
use cmu\config\site\bin\Conf;

class ComputersSelectionFactory extends AbstractSelectionFactory

{
	protected function getDn() : string
	{
		return "ou=computers,ou=devices";
	}

	protected function targetClass() : string
	{
		return ComputersIdentityObject::class;
	}

}
