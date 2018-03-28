<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors;

use \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;

class ObjectToLdapConverter extends AbstractVisitor

{

	public function returnConvertedArray() : array
	{
		//Fluent Interface 
		$record = $this->mod	
			->recurse_expose_private_and_protected()
			->move_elements_up_if_not_in_entity_map()
			->reverse_remap_keys()
			->delete_key()
			->add_object_class()      
			->returnFinalArray() 
			;
		
		return $record;

	}

}
