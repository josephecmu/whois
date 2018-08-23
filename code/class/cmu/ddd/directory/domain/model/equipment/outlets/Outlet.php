<?php 
/*
* Entity
*
*
*/
namespace cmu\ddd\directory\domain\model\equipment\outlets;

use \cmu\ddd\directory\domain\model\lib\Dn;

class Outlet extends \cmu\ddd\directory\domain\model\lib\AbstractEntity

{

    protected $outletid;
	protected $dn;
	protected $computers=[];		//outlets hold multiple computers we only hold reference by ID. Not in aggregate.

	protected function getRequiredFields() : array				//returns array of required properties

	{

		return ["outletid", "dn"];	
		
	}

	public function setOutletid ($anoutletid)

	{

		$this->outletid =  $anoutletid;

	}

    public function setOutletdn (Dn $anoutletdn)

	{

		$this->outletdn = $anoutletdn;

	}
	public function getOutletid() : string
	{

		return $this->outletid;

	}

	public function getOutletdn() : Dn

	{

		return $this->dn;                                                                                         

	}

	public function getComputers() : array

	{
		return $this->computers;

	}	

	public function addComputerToOutlet (Dn $acomputerdn) 

	{

		$this->computers[] = $acomputerdn;

	}


}
