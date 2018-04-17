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

			// loop to add to find the outlets

				foreach($outlets as $outlet) {

						
					//lookup the outlet
					//
					//
					//get the array




					$room->assign($outlet_properties);		//room will create object and add to Room::outlets



				}	


			//or add the outlet????


		}	




		return $room;


	}

}

