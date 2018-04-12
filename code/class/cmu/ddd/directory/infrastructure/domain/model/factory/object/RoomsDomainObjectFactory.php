<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use \cmu\ddd\directory\domain\model\locations\Rooms;

class RoomsDomainObjectFactory extends AbstractDomainObjectFactory

{

	public function createObject(array $norm_array) : Rooms

	{

		return new Rooms($norm_array);
		
	}

}

