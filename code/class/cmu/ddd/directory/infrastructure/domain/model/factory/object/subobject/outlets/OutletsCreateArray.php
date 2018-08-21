<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets;

use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\OutletsDn;

class OutletsCreateArray extends AbstractOutlets
{

		public function returnArray(array $dataarray) : array
		{

			$outletid = $dataarray['outletid'];

			$idobj = $this->getIdObjectSearchById($outletid);

			if (!$this->returnRawArrayFromIdobject($idobj)['count'] == 0) {

				throw new \Exception("This " .  $outletid . "  exists!!");
			}

			//need a new identity
			$dn = (new OutletsDn())->buildDn($outletid);

			$dataarray['dn']=$dn;

			return $dataarray;

		}

}
