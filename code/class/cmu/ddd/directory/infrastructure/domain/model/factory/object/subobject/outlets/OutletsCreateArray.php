<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets;

use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\OutletsDn;
use \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\OutletsMapper;

class OutletsCreateArray extends AbstractOutlets
{
	public function returnNormArray(array $dataarray) : array
	{
		$outletid = $dataarray['outletid'];
		$idobj = $this->getIdObjectSearchById($outletid);
		if (!$this->returnRawArrayFromIdobject($idobj)['count'] == 0) {
			throw new \Exception("This " .  $outletid . "  exists!!");
		}
		//need a new identity
		$dn = (new OutletsDn())->buildDn($outletid);
		$dataarray['dn']=$dn;
		return (new OutletsMapper($dataarray))->return_dto_to_domain_array();
	}
}
