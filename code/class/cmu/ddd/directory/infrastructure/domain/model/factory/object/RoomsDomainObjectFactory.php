<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use \cmu\ddd\directory\domain\model\locations\Rooms;

class RoomsDomainObjectFactory extends AbstractDomainObjectFactory

{

	public function createObject(array $norm_array) : Rooms

	{

		//strip out the outlets
		if (array_key_exists('outlets', $norm_array)) {

			$outlets=$norm_array['outlets'];

			unset($norm_array['outlets']);

		}

		echo "<pre>";
		print_r($norm_array);

		$room = new Rooms($norm_array);

		if ($outlets) {		//if we set $outlets above

			$room->assignOutletToRoom($outlet_properties);		//room will create object and add to Room::outlets

		}	

		return $room;

	}

}

