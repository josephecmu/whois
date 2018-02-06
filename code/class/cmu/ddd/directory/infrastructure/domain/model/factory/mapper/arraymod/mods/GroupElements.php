<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;

class GroupElements extends AbstractMods
{

	public function modify($k, $v)
	{

		
		$group_map = $this->obj->GetGroupMap();

			if (array_key_exists($k, $group_map)) {
				$group = $group_map[$k];
					$this->temp[$group][$k] = $v;
			} else {

				$this->temp[$k] = $v;
			}
	}

}
