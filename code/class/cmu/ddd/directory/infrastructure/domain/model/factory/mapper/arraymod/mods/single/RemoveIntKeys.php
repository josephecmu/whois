<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class RemoveIntKeys extends AbstractSingleMods
{

	public function s_modify($k, $v)
	{
		if (!is_int($k)) {
			$this->temp[$k]=$v;
		} 
	}

}
