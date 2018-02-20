<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;

class ExposePrivate extends AbstractMods
{

	public function modify($k, $v)
	{

		if (strpos($k, "\0") !== false){ 
			$aux = explode ("\0", $k);
			$k = $aux[count($aux)-1];	
		}

		$this->temp[$k] = $v;
	}


}
