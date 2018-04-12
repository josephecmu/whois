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
	protected $outletdn;
	protected $computerdn=[];		//outlets hold multiple computers we only hold reference by ID. Not in aggregate.

	public function setOutletid ($anoutletid)

	{

		$this->outletid =  $anoutletid;

	}

	public function getOutletid() : string
	{

		return $this->outletid;

	}

	public function getOutletdn() : string

	{

		return $this->outletdn;                                                                                         

	}

	public function getComputerdn() : array

	{
		return $this->computerdn;

	}	
    public function setOutletdn (Dn $anoutletdn)

	{

		$this->outletdn = $anoutletdn;

	}

	public function addComputerToOutlet (Dn $acomputerdn) 

	{

		$this->computerdn[] = $acomputerdn;

	}

}
