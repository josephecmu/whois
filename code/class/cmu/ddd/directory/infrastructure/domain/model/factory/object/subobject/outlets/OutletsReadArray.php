<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets;

class OutletsReadArray extends AbstractOutlets
{
	public function returnNormArray(array $dataarray) : array
	{
		$outletid = ldap_explode_dn($dataarray['dn'], 1)[0];
		$idobj = $this->getIdObjectSearchById($outletid);
		$raw = $this->returnRawArrayFromIdobject($idobj);
		return $this->returnSingleNormArrayLdapToDomain($raw);
	}
}
