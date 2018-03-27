<?php 
/*
* Entity
*
*
*/
namespace cmu\ddd\directory\domain\model\actors\people;

class People extends \cmu\ddd\directory\domain\model\lib\AbstractEntity

{

    protected $name;
    protected $andrewid;
    protected $peoplerdn;       
	protected $roles=[];  				                           //can be BOTH Staff and Faculty	
	protected $email;

	protected function getRequiredFields() : array				//returns array of required properties

	{

		return ["name", "peoplerdn"];	
		
	}

    //setters below called by Dynamic setter
	protected function setName(array $aname)

	{

		$this->name = new Name($aname);

	}

    protected function setAndrewid (string $anid)

    {

         $this->andrewid = new AndrewID($anid);

    }
	
	protected function setRoles (array $roles)
	{

		$this->roles = $roles;

	}

	protected function setEmail (array $email)
	{

		$this->email = new Email($email);

	}

    protected function setPeoplerdn (string $anrdn)

    {

        $this->peoplerdn = new \cmu\ddd\directory\domain\model\lib\Dn($anrdn);

    }
    //The room must exist in the code below.  The Service layer should make sure of that. (findRoomOrFail)
    public function assignUserToRoom($room) : cmu\ddd\directory\domain\model\locations\Rooms

    {

		return new cmu\ddd\directory\domain\model\locations\Rooms ($this->peoplerdn, $room);

    }
	#The computer must be assigned to a room before assigned to a user. The service layer should verify?
	public function assignUserToComputer($computer) : cmu\ddd\directory\domain\model\equipment\computers\Computer

	{
		return new cmu\ddd\directory\domain\model\equipment\computers\Computer ($this->peoplerdn, $computer);

	}

}
