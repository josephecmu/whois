<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class ToArray extends AbstractSingleMods
{

	public function s_modify($k, $v)
	{

		$to_array_map = $this->obj->GetToArray();

		if (in_array($k, $to_array_map)) {

			$v = [0=>$v];
		}

		$this->temp[$k] = $v;	
	}

}
