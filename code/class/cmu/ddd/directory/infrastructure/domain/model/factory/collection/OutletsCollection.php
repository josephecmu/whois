<?php

namespace  cmu\ddd\directory\infrastructure\domain\model\factory\collection;

use cmu\ddd\directory\domain\model\equipment\outlets\Outlets; 

class OutletsCollection extends AbstractCollection
{

	public function targetClass(): string
	{
		return Outlets::class;
	}

}

