<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods\single;

class MoveElementsUpIfNotInEntityMap extends AbstractSingleMods
{

	public function s_modify($k, $v)
	{
		//If the key is NOT in entitymap (move up)
		$entity_map = $this->obj->getEntityMap();	

		if (!in_array($k, $entity_map)  
			&& 
			!empty($v) 
			&& 
			is_array($v)
			){
				//move the elements up one level
				foreach($v as $k1 => $v1) {

					$this->temp[$k1] = $v1;			

				} 

			} else {       											//leave it alone
				$this->temp[$k] = $v;
		}

	}	

}
