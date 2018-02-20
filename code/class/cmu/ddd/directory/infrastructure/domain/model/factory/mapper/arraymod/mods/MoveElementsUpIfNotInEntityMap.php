<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;

class MoveElementsUpIfNotInEntityMap extends AbstractMods
{

	public function modify($k, $v)
	{

		//If the first character of the key is NOT a letter, flatten array (move up)
		$entity_map = $this->obj->getEntityMap();		
		if (!in_array($k, $entity_map)) {
			//move the elements up one level
			foreach($v as $k1 => $v1) {

				$this->temp[$k1] = $v1;			

			}

		}	

	}

}
