<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity; 
use \cmu\ddd\directory\domain\model\actors\people\People;
use \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\PeopleMapper;

class PeopleDomainObjectFactory extends AbstractDomainObjectFactory

{

	public function createObject(array $norm_array) : AbstractEntity

	{

		$obj = new People($norm_array);

		return $obj;
	}

}
