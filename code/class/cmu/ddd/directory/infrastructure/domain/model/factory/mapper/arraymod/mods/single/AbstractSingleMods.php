<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\AbstractMods;

abstract class AbstractSingleMods extends AbstractMods
{

	abstract public function s_modify($k, $v);

	public function act_on_single_array_depth(array $array)
	{
		foreach ($array as $k => $v) {

			$this->s_modify($k, $v);	

		}

	}

}
