<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;

class RemoveIntKeys extends AbstractMods
{

	public function modify($k, $v)
	{
		if (!is_int($k)) {
			$this->temp[$k]=$v;
		} 
	}

}
