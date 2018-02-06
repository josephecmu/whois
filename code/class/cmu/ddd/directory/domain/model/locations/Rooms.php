<?php
/*
 *
 *Entity ROOT
 *
 *
 */
namespace cmu\ddd\directory\domain\model\locations;

class Rooms extends \cmu\ddd\directory\domain\model\lib\AbstractEntity

{

	protected $roomrdn;
	protected $outlets=[]; //should be list of outlet objects 
	protected $roomnumber;

    protected function setRoomrdn (string $anrdn)

    {

        $this->roomrdn = new \cmu\ddd\directory\domain\model\lib\Dn($anrdn);

    }

	private function outletFactory (array $properties) : \cmu\ddd\directory\domain\model\equipment\outlets\Outlet

	{   

		$properties["outletrdn"] = new \cmu\ddd\directory\domain\model\lib\Dn($properties["outletrdn"]);

		return new \cmu\ddd\directory\domain\model\equipment\outlets\Outlet ($properties);

	}
	public function assignOutletToRoom (array $properties) 

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
