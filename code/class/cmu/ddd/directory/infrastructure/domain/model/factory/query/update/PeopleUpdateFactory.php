<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\update;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class PeopleUpdateFactory extends AbstractUpdateFactory

{

	protected function getRdn(AbstractEntity $obj ) : string

	{

		return $obj->dynGet("peoplerdn")->dynGet("dn");

	}

}
