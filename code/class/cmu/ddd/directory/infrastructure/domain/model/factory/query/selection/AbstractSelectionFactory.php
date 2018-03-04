<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

use \cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;

abstract class AbstractSelectionFactory

{
	
abstract public function newSelection(AbstractIdentityObject $obj): array;

public function buildFilter(AbstractIdentityObject $obj): string

{
	
	if ($obj->isVoid()) {
		return ["", []];
	}

	$compstrings = [];
	foreach ($obj->getComps() as $comp) {
		$compstrings[] = "({$comp['name']}{$comp['operator']}{$comp['value']})";
	}
	$filter = "(&" .  implode(" ",$compstrings) . ")" ;
	return $filter;
	

}

##added josephe 10-12-17
protected function getLocation ($path) {

	return $path . ",dc=mcs,dc=cmu,dc=edu";

}

}
