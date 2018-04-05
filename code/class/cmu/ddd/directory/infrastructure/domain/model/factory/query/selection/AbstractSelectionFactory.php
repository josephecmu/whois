<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

use \cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;
use \cmu\ddd\directory\infrastructure\domain\model\factory\query\AbstractQuery;
use \cmu\ddd\directory\infrastructure\domain\model\share\TraitTargetClass;

abstract class AbstractSelectionFactory

{

	use TraitTargetClass;
		
	abstract protected function getDn() : string;
	
	public function buildAndFilter(AbstractIdentityObject $obj): string

	{
		
		$this->verifyTargetClass($obj);	

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

    public function buildOrFilter(AbstractIdentityObject $obj): string

    {

        $this->verifyTargetClass($obj);

        if ($obj->isVoid()) {
            return ["", []];
        }

        $compstrings = [];
        foreach ($obj->getComps() as $comp) {
            $compstrings[] = "({$comp['name']}{$comp['operator']}{$comp['value']})";
        }
        $filter = "(|" .  implode(" ",$compstrings) . ")" ;
        return $filter;

    }

	##added josephe 10-12-17
	protected function getLocation ($path) {

		return $path . ",dc=mcs,dc=cmu,dc=edu";

	}

	public function newAndSelection(AbstractIdentityObject $obj): array
	{

		$dn = $this->getDn();								//concrete implementation
		$fields = $obj->getObjectFields();
		$filter = $this->buildAndFilter($obj);
		$location = $this->getLocation($dn);
		return [$location, $fields, $filter];
	}

    public function newOrSelection(AbstractIdentityObject $obj): array
    {

        $dn = $this->getDn();								//concrete implementation
        $fields = $obj->getObjectFields();
        $filter = $this->buildOrFilter($obj);
        $location = $this->getLocation($dn);
        return [$location, $fields, $filter];
    }
}
