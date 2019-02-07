<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets;

class OutletsDeleteArray extends AbstractOutlets
{
	public function returnNormArray(array $dataarray) : array
	{
		$mapper = $this->fact->getMapper($dataarray);
		return $mapper->return_dto_to_domain_array(); 
	}
}
