<?php

namespace  cmu\ddd\directory\infrastructure\domain\model\factory\collection;

use cmu\ddd\directory\domain\model\equipment\computers\Computer; 

class ComputersCollection extends AbstractCollection

{

	public function targetClass(): string
	{
		return Computer::class;
	}

}
