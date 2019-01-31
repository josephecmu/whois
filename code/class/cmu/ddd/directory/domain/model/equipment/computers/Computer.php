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

	protected $computerid;
    protected $computername;
    protected $computeros;
    protected $dn;


	protected function getRequiredFields() : array				//returns array of required properties
	{
		return ["dn", "computerid"];	
	}

    protected function setDn (string $adn) : void
    {
        $this->dn = new Dn($adn);
	}

    protected function setComputerid (string $acomputerid) : void
    {
        $this->computerid = $acomputerid;
	}

	protected function setComputeros(string $acomputeros) : void
	{
		$this->computeros = $acomputeros;
	}

	protected function setComputername(string $acomputername) : void
	{
		$this->computername = $acomputername;
	}
}
