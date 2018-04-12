<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\domain\model\locations\Rooms;
use cmu\ddd\directory\application\services\AbstractService;

abstract class AbstractRoomsService extends AbstractService 
{
	
	public function targetClass(): string
	{
		return Rooms::class;
	}

}
