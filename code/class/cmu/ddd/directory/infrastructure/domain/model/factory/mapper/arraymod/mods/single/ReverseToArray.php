<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class ReverseToArray extends AbstractSingleMods
{

	public function s_modify($k, $v) : void
	{
		$to_array_map = $this->obj->GetToArray();

		if (in_array($k, $to_array_map)) {
			$v = reset($v);
		}

		$this->temp[$k] = $v;	
	}
}
