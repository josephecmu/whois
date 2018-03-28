<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\append;

class AddObjectClass extends AbstractAppendMods
{

	public function a_modify()
	{
		$object_class_map = $this->obj->getObjectClassMap();	

		$this->temp['objectclass'] = $object_class_map;

	}	

}
