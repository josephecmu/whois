<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\AbstractMods;

abstract class AbstractSingleMods extends AbstractMods
{
	abstract public function s_modify($k, $v) : void ;

	public function act_on_single_array_depth(array $array) : void
	{
		foreach ($array as $k => $v) {
			$this->s_modify($k, $v);	
		}
	}
}
