<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class RemapKeys extends AbstractSingleMods
{

	public function s_modify($k, $v) : void
	{
		$name_map = $this->obj->getNameMap();

		if (array_key_exists($k, $name_map)) {
			$k=$name_map[$k];
		}
		$this->temp[$k] = $v; 
	}
}
