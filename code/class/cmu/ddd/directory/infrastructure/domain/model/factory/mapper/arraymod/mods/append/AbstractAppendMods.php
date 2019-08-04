<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\append;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\AbstractMods;

abstract class AbstractAppendMods extends AbstractMods
{
	public function append_array(array $array) : void
	{
		$this->temp = $array;
		$this->a_modify();
	}

	abstract protected function a_modify() : void;
}
