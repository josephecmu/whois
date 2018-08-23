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
	protected $outlets = null; 							//should be list of ethernet outlet objects 

	protected function getRequiredFields() : array				//returns array of required properties

	{

		return ["roomid", "dn", "roomnumber"];	
		
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
		if (!isset($properties["dn"])){

			throw new \Exception("I can't hydrate 'Outlets' without a DN!");

		}

		$properties["dn"] = new Dn($properties["dn"]);

		return new Outlet ($properties);

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

	public function getOutlets() 		//may return null or array

	{
		return $this->outlets ?? null;

	}

	public function removeOutletFromRoom (Outlet $outlet)
	{

		$dn = $outlet->getOutletdn()->getDn();	//The Dn is an object 

		foreach ($this->outlets as $k => $v) {

			if ($v->getOutletDn()->getDn() == $dn) {
				
				$key = $k;
				break;	
			}

		}

		unset($this->outlets[$key]);

	}

}
