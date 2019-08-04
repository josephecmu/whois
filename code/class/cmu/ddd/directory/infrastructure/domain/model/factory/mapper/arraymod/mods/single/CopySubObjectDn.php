<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class CopySubObjectDn extends AbstractSingleMods
{

	public function s_modify($k, $v) : void
	{	
		$sub_object_map = $this->obj->getSubObjectMap();

		if ($k != 0) {	//FUfor some reason, key is zero when testing Room and computer 8-4-19
		 if (in_array($k, $sub_object_map) && !empty($v)) {
			foreach ($v as $subobj_array) {   //$v is array of objects array (outlets)
				$array[] = $subobj_array['dn']['dn']; //return the Dn object, then return the property.
			}
			$this->temp[$k] = $array;
		}
		} else {
			$this->temp[$k] = $v;
		}
	}
}
