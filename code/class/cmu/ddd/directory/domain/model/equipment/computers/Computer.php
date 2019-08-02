<?php 
/*
* Entity
*
*
*/
namespace cmu\ddd\directory\domain\model\equipment\computers;

use \cmu\ddd\directory\domain\model\lib\Dn;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;

class Computer extends AbstractEntity
{

	protected $computerid;			// cn
    protected $computername; 		// ?? must map to another attribute
    protected $operatingsystem;		// operatingSystem
    protected $dn;					

	protected function getRequiredFields() : array				//returns array of required properties
	{
		return ["dn", "computerid"];	
	}

	public function getComputerdn() : Dn
	{
		return $this->dn;                                                                                         
	}

    protected function setComputerid (string $acomputerid) : void
    {
        $this->computerid = $acomputerid;
	}

	protected function setComputername(string $acomputername) : void
	{
		$this->computername = $acomputername;
	}

	protected function setOperatingsystem(string $aoperatingsystem) : void
	{
		$this->operatingsystem = $aoperatingsystem;
	}

    protected function setDn (string $adn) : void
    {
        $this->dn = new Dn($adn);
	}
}
