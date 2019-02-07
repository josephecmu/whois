<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\domain\model\actors\people\People;

class PeopleRepository extends AbstractRepository 
{

	public function targetClass(): string
	{
		return People::class;
	}
}

