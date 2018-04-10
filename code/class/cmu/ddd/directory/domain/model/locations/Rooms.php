<?php
/*
 *
 *Entity ROOT
 *
 *
 */
namespace cmu\ddd\directory\domain\model\locations;

use \cmu\ddd\directory\domain\model\lib\Dn;
use \cmu\ddd\directory\domain\model\equipment\outlets\Outlet;
use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class Rooms extends AbstractEntity
{

	protected $roomrdn;
	protected $outlets=[]; 							//should be list of outlet objects 
	protected $roomnumber;

    protected function setRoomrdn (string $anrdn)

    {

        $this->roomrdn = new Dn($anrdn);

    }

	private function outletFactory (array $properties) : Outlet

	{   

		$properties["outletrdn"] = new Dn($properties["outletrdn"]);

		return new Outlet ($properties);

	}
	private function assignOutletToRoom (array $properties) 

	{
		
		##we assign the outlet object to the property of this class, a Room.
		$this->outlets[] = $this->outletFactory($properties);

	}
	#must iterate through multi-dimensional array, create objects, and assign to $this->outlets.
	public function setOutlets (array $someoutlets) 

	{
	
		foreach ( $someoutlets as $someoutlet) {
	
			$this->assignOutletToRoom($someoutlet);

		}

	}

}
