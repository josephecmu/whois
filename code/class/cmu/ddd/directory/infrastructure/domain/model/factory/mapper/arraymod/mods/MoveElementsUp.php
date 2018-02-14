<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;

class MoveElementsUp extends AbstractMods
{

	public function modify($k, $v)
	{

		//If the first character of the key is NOT a letter, flatten array
		//(remove the key and move elements up one level)
		if (!ctype_alpha(substr($k, 0, 1))) { 

			//move the elements up one level

			$this->temp[$k] = $v;			

		}	

	}

}
