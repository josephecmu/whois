<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use \cmu\ddd\directory\domain\model\actors\people\People;

class PeopleDomainObjectFactory extends AbstractDomainObjectFactory

{

	public function createObject(array $norm_array) : People

	{

		$obj = new People($norm_array);

		return $obj;
	}

}
