<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class RemoveKey extends AbstractSingleMods
{

	public function s_modify($k, $v)
	{	
		$remove_key_map = $this->obj->getRemoveKeyMap();

		print_r($remove_key_map);

			if (!in_array($k, $remove_key_map)) {	//only add if NOT in delete_key_map (deleting by not adding)
			
				$this->temp[$k] = $v;
			}
	}

}
