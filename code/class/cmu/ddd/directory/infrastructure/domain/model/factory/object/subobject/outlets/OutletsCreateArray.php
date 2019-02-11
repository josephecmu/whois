<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets;

class OutletsCreateArray extends AbstractOutlets
{
	public function returnNormArray(array $dataarray) : array
	{

		$outletid = $dataarray[$this->idname];
		$idobj = $this->getIdObjectSearchById($outletid);
		if (!$this->returnRawArrayFromIdobject($idobj)['count'] == 0) {
			throw new \Exception("This " .  $outletid . "  exists!!");
		}
		//need a new identity
		$dnfact = $this->fact->getDn();
		$dn = $dnfact->buildDn($outletid);

		$dataarray['dn']=$dn;

		$mapper = $this->fact->getMapper($dataarray);
		return $mapper->return_dto_to_domain_array();
	}
}
