<?php 
/*
* Entity
*
*
*/
namespace cmu\domain\model\directory\equipment\computers;

use \cmu\ddd\directory\domain\model\lib\Dn;

class Computer extends \cmu\domain\model\directory\AbstractEntity
{

	protected $computerid;			// cn
    protected $computername; 		// ?? must map to another attribute
    protected $operatingsystem;		// operatingSystem
    protected $dn;					


	protected function getRequiredFields() : array				//returns array of required properties
	{
		return ["dn", "computerid"];	
	}

    protected function setComputerid (string $acomputerid) : void
    {
        $this->computerid = $acomputerid;
	}

	protected function setComputername(string $acomputername) : void
	{
		$this->computername = $acomputername;
	}

	protected function setOperatingsystem(string $acomputeros) : void
	{
		$this->computeros = $acomputeros;
	}

    protected function setDn (string $adn) : void
    {
        $this->dn = new Dn($adn);
	}

}
