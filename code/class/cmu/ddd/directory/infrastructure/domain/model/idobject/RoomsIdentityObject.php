<?php

namespace cmu\ddd\directory\infrastructure\domain\model\idobject;

use cmu\config\site\bin\Conf;

class RoomsIdentityObject extends AbstractIdentityObject
{

	protected function returnConcreteConfigObject(array $options) : Conf
	{
		return $this->returnConfigObject($options['rooms']);
	}

}
