<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\update;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class PeopleUpdateFactory extends AbstractUpdateFactory

{

	public function newUpdate(AbstractEntity $obj): array
	{

		$rdn=$obj->dynGet("peoplerdn")->dynGet("dn");

		$raw = $this->object_to_array($obj);

		$mapper = $this->factory->getMapper($raw);

		$input = $mapper->return_object_to_ldaparray();

		return [$rdn, $input];

	}

}

