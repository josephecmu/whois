<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\update;

use \cmu\ddd\directory\domain\model\lib\AbstractEntity;

class PeopleUpdateFactory extends AbstractUpdateFactory

{

	public function newUpdate(AbstractEntity $obj): array
	{


	//get RDN		
		$aid=$obj->dynGet("andrewid")->getAndrewid();
		$rdn1="uid=" . $aid . ",ou=people,dc=mcs,dc=cmu,dc=edu";
		echo $rdn1;
		echo "<br />";
//	--------			OR -----------
		$rdn2=$obj->dynGet("peoplerdn")->dynGet("dn");
		echo $rdn2;
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


//		return $this->buildStatement($rdn, $input);		

	}

}

