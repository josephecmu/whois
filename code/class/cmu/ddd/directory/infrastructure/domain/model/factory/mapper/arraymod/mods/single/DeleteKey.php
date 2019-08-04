<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class DeleteKey extends AbstractSingleMods
{

	public function s_modify($k, $v) :void
	{	
		$delete_key_map = $this->obj->GetDeleteKeyMap();
		if (!in_array($k, $delete_key_map)) {	//only add if NOT in delete_key_map (deleting by not adding)
			$this->temp[$k] = $v;
		}
	}

}
