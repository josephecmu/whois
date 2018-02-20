<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

use  \cmu\ddd\directory\infrastructure\domain\model\idobject\IdentityObject ;

class PeopleSelectionFactory extends AbstractSelectionFactory

{

	public function newSelection(IdentityObject $obj): array
	{
		
		$dn = "ou=people"; 
//		$fields = '"' .  implode('", "', $obj->getObjectFields()) . '"';
		$fields = $obj->getObjectFields();
		$filter = $this->buildFilter($obj);
		$location = $this->getLocation($dn);
		return [$location, $fields, $filter];
	}

}
