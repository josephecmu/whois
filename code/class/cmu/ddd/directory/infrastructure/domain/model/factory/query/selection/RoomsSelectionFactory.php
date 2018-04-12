<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

use cmu\ddd\directory\infrastructure\domain\model\idobject\RoomsIdentityObject;
use cmu\config\site\bin\Conf;

class RoomsSelectionFactory extends AbstractSelectionFactory

{

	protected function getDn() : string
	{

		return "ou=rooms";

	}

	protected function targetClass() : string
	{

		return RoomsIdentityObject::class;

	}

}

