<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\recursive;

class ExposePrivateAndProtected extends AbstractRecursiveMods
{

	protected function change($k, $v, array &$array)
	{

		if (strpos($k, "\0") !== false){	
			unset ($array[$k]);
				$aux = explode ("\0", $k);
				$k = $aux[count($aux)-1];
				$array[$k] = $v;	
		}

	}

}
