<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\update;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class PeopleUpdateFactory extends AbstractUpdateFactory

{

	public function newUpdate(AbstractEntity $obj): string
	{

		$rdn=$obj->dynGet("peoplerdn")->dynGet("dn");

		return $rdn;

	}

}

