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

	protected $dn;
	protected $roomid;
	protected $roomnumber;
	protected $outlets; 							//should be list of ethernet outlet objects 

	protected function getRequiredFields() : array				//returns array of required properties

	{

		return ["roomid", "dn", "roomnumber" ];	
		
	}

    protected function setDn (string $adn)

    {

        $this->dn = new Dn($adn);

    }
	protected function setRoomid(string $aroomid)
	{

		$this->roomid = $aroomid;		//no ValueObject

	}

	protected function setRoomnumber(string $aroomnumber)
	{

		$this->roomnumber = $aroomnumber;		//no ValueObject

	}

	private function outletFactory (array $properties) : Outlet

	{   

		$properties["outletdn"] = new Dn($properties["outletdn"]);

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

	public function getOutlets() : array

	{

		return $this->outlets;

	}
}
