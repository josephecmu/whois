<?php

namespace  cmu\ddd\directory\infrastructure\domain\model\factory\collection;

use cmu\ddd\directory\domain\model\actors\people\Rooms; 

class RoomsCollection extends AbstractCollection

{

	public function targetClass(): string
	{
		return Rooms::class;
	}

}

