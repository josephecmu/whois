<?php 
/*
* Entity
*
*
*/
namespace cmu\ddd\directory\domain\model\equipment\outlets;

use \cmu\ddd\directory\domain\model\lib\Dn;
use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class Outlet extends AbstractEntity
{

    protected $outletid;
	protected $dn;

	protected function getRequiredFields() : array				//returns array of required properties
	{
		return ["outletid", "dn"];	
	}

	public function setOutletid ($anoutletid) : void
	{
		$this->outletid = $anoutletid;
	}
	//is this ever called????
    public function setOutletdn (Dn $anoutletdn) : void
	{
//		$this->outletdn = $anoutletdn;			//1-31-19
		$this->dn = $anoutletdn;
	}
	public function getOutletid() : string
	{
		return $this->outletid;
	}

	public function getOutletdn() : Dn
	{
		return $this->dn;                                                                                         
	}
}
