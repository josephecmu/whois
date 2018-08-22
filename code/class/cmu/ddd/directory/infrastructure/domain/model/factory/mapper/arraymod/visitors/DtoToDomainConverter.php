<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors;

use \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;

class DtoToDomainConverter extends AbstractVisitor

{

	public function returnConvertedArray() : array
	{

		$record = $this->mod 
		->group_elements()
		->remove_key()
		->returnFinalArray()			
		;

		return $record;

	}




}
