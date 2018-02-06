<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;

class RemapKeys extends AbstractMods
{

	public function modify($k, $v)
	{

		$name_map = $this->obj->getNameMap();

		if (array_key_exists($k, $name_map)) {
			$k=$name_map[$k];
		}
		$this->temp[$k] = $v; 

	}

}





