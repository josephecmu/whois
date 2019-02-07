<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\domain\model\equipment\computers\Computer;

class ComputersRepository extends AbstractRepository 
{
	public function targetClass(): string
	{
		return Computer::class;
	}

}
