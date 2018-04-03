<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\application\services\AbstractService;

abstract class AbstractPeopleService extends AbstractService 
{
	
	protected $ou = "ou=people";
	protected $idatt = "uid";

	public function targetClass(): string
	{
		return People::class;
	}

}
