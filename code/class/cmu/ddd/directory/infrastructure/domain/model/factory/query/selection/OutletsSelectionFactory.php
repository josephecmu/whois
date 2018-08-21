<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

use cmu\ddd\directory\infrastructure\domain\model\idobject\OutletsIdentityObject;
use cmu\config\site\bin\Conf;

class OutletsSelectionFactory extends AbstractSelectionFactory

{

	protected function getDn() : string
	{

		return "ou=outlets,ou=devices";

	}

	protected function targetClass() : string
	{

		return OutletsIdentityObject::class;

	}

}

