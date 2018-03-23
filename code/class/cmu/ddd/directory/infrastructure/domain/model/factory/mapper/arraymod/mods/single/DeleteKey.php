<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class DeleteKey extends AbstractSingleMods
{

	public function s_modify($k, $v)
	{	//untested 3-19-18
		$delete_key_map = $this->obj->GetDeleteKeyMap();

			if (! array_key_exists($k, $delete_key_map)) {	//only add if NOT in delete_key_map (deleting by not adding)
			
				$this->temp[$k] = $v;
			}
	}

}
