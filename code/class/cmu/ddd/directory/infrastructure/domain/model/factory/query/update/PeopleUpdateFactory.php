<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\update;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class PeopleUpdateFactory extends AbstractUpdateFactory

{

	public function newUpdate(AbstractEntity $obj): string
	{

	//get RDN		
//		$aid=$obj->dynGet("andrewid")->getAndrewid();
//		$rdn1="uid=" . $aid . ",ou=people,dc=mcs,dc=cmu,dc=edu";
//		echo $rdn1;
//		echo "<br />";
//	--------			OR -----------
		$rdn=$obj->dynGet("peoplerdn")->dynGet("dn");
//end get RDN
//		 $id = $obj->getId();
//		 $cond = null;
//		 $values['name'] = $obj->getName();
//
//		 if ($id > -1) {
//			 $cond['id'] = $id;
//		 }
//
//		 return $this->buildStatement("venue", $values, $cond);


		// return array...[]0 = $rdn    [2] = LDAP array
		
		//pass the array to AbstractUpdateFactory::buildStatement()
//		$ldap_array = $this->buildStatement($obj_array);	


		return $rdn;

	}

}

