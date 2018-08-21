<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class CopySubObjectDn extends AbstractSingleMods
{

	public function s_modify($k, $v)
	{	
		$sub_object_map = $this->obj->getSubObjectMap();

		if (in_array($k, $sub_object_map)) {			//outlets values from map will match the key.

			foreach ($v as $subobj_array) {   //$v is array of objects array (outlets)

				$array[] = $subobj_array['dn']['dn']; //return the Dn object, then return the property.

			}

			$this->temp[$k] = $array;

		} else {

			$this->temp[$k] = $v;
		}

	}

}