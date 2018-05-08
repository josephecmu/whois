<?php
//(This factory id the DOA for Outlets).
namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use \cmu\ddd\directory\domain\model\locations\Rooms;
use \cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets\OutletsCreateArray;
use \cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets\OutletsReadArray;
use \cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets\OutletsUpdateArray;

class RoomsDomainObjectFactory extends AbstractRootDomainObjectFactory

{

	public function createObject(array $norm_array) : Rooms

	{
		
		if (array_key_exists('outlets', $norm_array)) {


			$outlets=$norm_array['outlets'];
			unset($norm_array['outlets']);

			$outletstemp = [];
			foreach ($outlets as $outlet) { 

				$outletstemp[] = $this->returnNormDataArray($outlet);
				
			}	

		}

		$room = new Rooms($norm_array);

		if (isset($outletstemp)) {		//if we set $outlets above

			$room->assignOutletToRoom($outletstemp);		//room will create object and add to Room::outlets

		}	

		return $room;

	}

	protected function getAction(array $dataarray) : string
	{

		if (isset($dataarray['outletid']) && (isset($dataarray['dn']))) {							//UPDATE

			return "update";

		} elseif (isset($dataarray['outletid']))  { 											//CREATE

			return "create";

		} elseif (isset($dataarray['dn'])) {													//READ

			return "read";

		}

	}

	protected function returnNormDataArray(array $dataarray) : array
	{

		$action = $this->getAction($dataarray);	

		switch ($action) {
			case "create":						
				return (new OutletsCreateArray($dataarray))->returnArray();

			case "read":					
				return (new OutletsReadArray($dataarray))->returnArray();

			case "update":				
				return (new OutletsUpdateArray($dataarray))->returnArray();
		}
	}
}

