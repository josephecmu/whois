<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets;

use \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\OutletsMapper;

class OutletsUpdateArray extends AbstractOutlets
{
		public function returnNormArray(array $dataarray) : array
		{
			return (new OutletsMapper($dataarray))->return_dto_to_domain_array(); 
		}
}
