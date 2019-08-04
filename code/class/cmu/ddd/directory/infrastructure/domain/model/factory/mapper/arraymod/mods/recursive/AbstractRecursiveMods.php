<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\recursive;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\AbstractMods;

abstract class AbstractRecursiveMods extends AbstractMods
{

	abstract protected function change($k, $v, array &$array) : void;			//template method

	public function act_on_recursive_array_depth(array $array) : void 
	{
		$this->temp=$this->r_modify($array);						//$this->temp must hold the array to be returned	
	}

	public function r_modify(array &$array) : array
	{
		foreach ($array as $k => &$v) {
			if (is_array($v)) {
					$this->r_modify($v);
				}
			$this->change($k, $v, $array);  							//template method
		}
		return $array;
	}
}
