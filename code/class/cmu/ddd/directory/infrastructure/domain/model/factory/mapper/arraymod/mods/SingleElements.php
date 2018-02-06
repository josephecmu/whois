<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;

class SingleElements extends AbstractMods
{

	public function modify($k, $v)
	{
		$single_map = $this->obj->GetSingleMap();

		if (in_array($k, $single_map)) {
			$v = $v[0];	
		} 

		$this->temp[$k] = $v;
	}

}
