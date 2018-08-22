<?php
//(This Rooms factory is the CRU Service for Outlets).
namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use \cmu\ddd\directory\domain\model\locations\Rooms;
use cmu\ddd\directory\domain\model\equipment\outlets\Outlet;  
use \cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets\OutletsCreateArray;
use \cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets\OutletsReadArray;
use \cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets\OutletsUpdateArray;

class RoomsDomainObjectFactory extends AbstractRootDomainObjectFactory

{

	public function createObject(array $norm_array) : Rooms

	{

		if (isset($norm_array['outlets'])) {
			$outlets=$norm_array['outlets'];
			unset($norm_array['outlets']);
		}

		$room = new Rooms($norm_array);

		if (isset($outlets)) {
			foreach ($outlets as $outlet) {

				$norm_outlet =  $this->returnNormOutletArray($outlet, 'read');
				$room->assignOutletToRoom($norm_outlet);
			}

		}

		return $room;

	}

	public function returnNewOutlet(array $outlet, string $action)
	{

		$outlet_norm_array = $this->returnNormOutletArray($outlet, $action); 

		return new Outlet($outlet_norm_array);

	}
	
	//This can most likely be a Strategy or Visitor pattern and pushed up if we need to re-use
	public function returnNormOutletArray(array $subobjarray, string $action)
	{

		switch ($action) {
			case "create":						
				return (new OutletsCreateArray())->returnNormArray($subobjarray);

			case "read":					
				return (new OutletsReadArray())->returnNormArray($subobjarray);

			case "update":				
				return (new OutletsUpdateArray())->returnNormArray($subobjarray);
		}
	}
	//if re-use move the atts to config file.	
	public function getAction(array $subobjarray) : string
	{

		if ($subobjarray['delete'] == 'yes') {
			return "delete";

		} elseif (isset($subobjarray['outletid']) && (isset($subobjarray['dn'])))  {
			return "update";

		} elseif (isset($subobjarray['dn']))  { 
			return "read";

		} elseif (isset($subobjarray['outletid']))  { 											
			return "create";
	
		} else { 
			throw new \Exception("I don't have a good action!");
		}
	}
}

