<?php 
/*
* Entity
*
*
*/
namespace cmu\ddd\directory\domain\model\actors\people;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\domain\model\locations\Rooms;
use cmu\ddd\directory\domain\model\equipment\computers\Computer;
use \cmu\ddd\directory\domain\model\lib\Dn;

class People extends AbstractEntity
{

	protected $name;
    	protected $andrewid;
    	protected $dn;       
	protected $roles=[];  				                           //can be BOTH Staff and Faculty	
	protected $email;
	protected $uidnumber;
	protected $gidnumber;
	protected $homedirectory;

	protected function getRequiredFields() : array				//returns array of required properties
	{
		return ["name", "dn", "gidnumber", "uidnumber", "homedirectory", "andrewid"];	
	}
	//setters below called by Dynamic setter
	protected function setName(array $aname) :void
	{
		$this->name = new Name($aname);
	}

	protected function setAndrewid (string $anid) :void
	{
	     $this->andrewid = new AndrewID($anid);
	}
	
	protected function setRoles (array $roles) : void
	{
		$this->roles = $roles;
	}

	protected function setEmail (array $email) : void
	{
		$this->email = new Email($email);
	}

    	protected function setDn (string $adn) : void
    	{
        	$this->dn = new Dn($adn);
    	}	

	protected function setUidnumber (int $auidnumber) : void
	{
		$this->uidnumber = new UidNumber($auidnumber);	
	}

	protected function setGidnumber (int $agidnumber) : void
	{
		$this->gidnumber = new GidNumber($agidnumber);	
	}

	protected function setHomedirectory($ahomedirectory) : void
	{
		$this->homedirectory = new HomeDirectory($ahomedirectory);
	}
	//The room must exist in the code below.  The Service layer should make sure of that. (findRoomOrFail)
	public function assignUserToRoom($room) : Rooms
	{
		return new Rooms ($this->dn, $room);
    	}
	#The computer must be assigned to a room before assigned to a user. The service layer should verify?
	public function assignUserToComputer($computer) : Computer
	{
		return new Computer ($this->dn, $computer);
	}
}
