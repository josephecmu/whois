<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors;

class ObjectToLdapConverterAdd extends AbstractVisitor
{
	public function returnConvertedArray() : array
	{
//		echo "ObjectToLdapConverterAdd.php  mod obj <pre>";
//		print_r($this->mod);
		//Fluent Interface 
		$record = $this->mod
			->recurse_expose_private_and_protected()
			->move_elements_up_if_not_in_entity_map()
			->copy_sub_obj_dn()
			->reverse_remap_keys()
			->delete_key()
			->add_object_class()      
			->delete_empty_key()			//new 8-18
			->returnFinalArray() 
			;
//		echo "ObjectToLdapConverterAdd.php  FINAL Record <pre>";
//		print_r($record);

		return $record;
	}
}
