i<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\update;

use \cmu\ddd\directory\domain\model\actors\people\People;

class PeopleUpdateFactory extends AbstractUpdateFactory

{

	protected function getRdn(People $obj ) : string

	{
		
		return $obj->dynGet("peoplerdn")->dynGet("dn");

	}

	protected function targetClass() : string
	{

		return PeopleIdentityObject::class;

	}

}
