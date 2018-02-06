<?php 
/*
* Entity
*
*
*/
namespace cmu\ddd\directory\domain\model\equipment\outlets;

class Outlet extends \cmu\ddd\directory\domain\model\lib\AbstractEntity

{

    protected $outletid;
	protected $outletrdn;
	protected $computerrdn=[];		//outlets hold multiple computers we only hold reference by ID. Not in aggregate.

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

		return $this->outletrdn;                                                                                         

	}

	public function getComputerrdn() : array

	{
		return $this->computerrdn;

	}	
    public function setOutletrdn (\cmu\ddd\directory\domain\model\lib\Dn $anoutletrdn)

	{

		$this->outletrdn = $anoutletrdn;

	}

	public function addComputerToOutlet (\cmu\ddd\directory\domain\model\lib\Dn $acomputerrdn) 

	{

		$this->computerrdn[] = $acomputerrdn;

	}

}
