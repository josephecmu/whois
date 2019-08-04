<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;
use cmu\config\site\bin\TraitConfig;

abstract class AbstractSelectionFactory
{

	use TraitConfig;
	
<<<<<<< HEAD
	public function buildAndFilter(AbstractIdentityObject $obj): string
=======
	protected $options;
>>>>>>> joe

	function __construct()
	{
		$this->options = $this->getConfigArray("config.ini");		
	}

	abstract protected function getOu() : string;

	public function buildFilter(AbstractIdentityObject $obj): string
	{
		if ($obj->isVoid()) {
			return ["", []];
		}
		$compstrings = [];
		foreach ($obj->getComps() as $comp) {
			$compstrings[] = "({$comp['name']}{$comp['operator']}{$comp['value']})";
		}
		
		$filter = "(" .  $obj->getGlobalcondition()    .   implode("",$compstrings) . ")" ;
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
		$dn = $this->getOu();								//concrete implementation
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
