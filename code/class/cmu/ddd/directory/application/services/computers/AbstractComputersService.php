<?php

namespace cmu\ddd\directory\application\services\computers;

use cmu\ddd\directory\domain\model\equipment\computers\Computer;
use cmu\ddd\directory\application\services\AbstractService;

abstract class AbstractComputersService extends AbstractService 
{
	protected $repo;

	public function targetClass() : string
	{
		return Computer::class;
	}
}
