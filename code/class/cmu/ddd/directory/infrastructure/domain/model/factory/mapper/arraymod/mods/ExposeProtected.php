<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;


class ExposeProtected extends AbstractMods
{
	//Protected methods have an "*" preceeding the key name.
	public function modify($k, $v)

	{

		if ((strpos($k, "*") == 1)) {
			//remove it
			$k = substr($k, 3);	

		}

		$this->temp[$k] = $v;

	}
	

}
