<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class DeleteEmptyKey extends AbstractSingleMods
{

	public function s_modify($k, $v)
	{	

		if (isset($v)) {	//only add if NOT empty (deleting by not adding)

			$this->temp[$k] = $v;
		}
	}

}
