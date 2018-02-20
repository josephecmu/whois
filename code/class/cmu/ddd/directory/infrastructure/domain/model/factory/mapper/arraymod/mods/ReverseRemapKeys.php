<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;

class ReverseRemapKeys extends AbstractMods
{

	public function modify($k, $v)
	{

		$name_map = $this->obj->getNameMap();
		$name_map = array_flip($name_map);

		if (array_key_exists($k, $name_map)) {
			$k=$name_map[$k];
		}
		$this->temp[$k] = $v; 

	}

}





