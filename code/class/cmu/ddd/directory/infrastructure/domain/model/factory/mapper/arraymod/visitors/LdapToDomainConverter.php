<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors;

use \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;

class LdapToDomainConverter extends AbstractVisitor

{

	public function returnConvertedArray() : array
	{
		 //Fluent Interface
		 $record = $this->mod  //we pass the concrete child mapper
			->remap_keys()
			->to_array()
			->single_elements()
			->remove_int_keys()
			->group_elements()
			->remove_count_recursive()
			->returnFinalArray()
			;

		 return $record;
	}

}
