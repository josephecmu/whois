<?php

namespace  cmu\ddd\directory\infrastructure\domain\model\factory\collection;

use cmu\ddd\directory\domain\model\actors\people\People; 

class PeopleCollection extends AbstractCollection
{
	public function targetClass(): string
	{
		return People::class;
	}
}
