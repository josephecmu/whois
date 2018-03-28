<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors;

use \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;

class ObjectToDTOConverter extends AbstractVisitor

{

	public function returnConvertedArray() : array

		{
			//Fluent Interface
			$record = $this->mod
				->recurse_expose_private_and_protected()
				->reverse_to_array()						
				->move_elements_up_if_not_in_entity_map()
				->returnFinalArray()
				;

			return $record;
		}

}
