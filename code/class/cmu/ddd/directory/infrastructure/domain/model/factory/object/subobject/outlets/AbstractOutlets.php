<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets;

use \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\OutletsMapper; 
use \cmu\ddd\directory\infrastructure\domain\model\idobject\OutletsIdentityObject;
use \cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\OutletsSelectionFactory;
use \cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\AbstractSubObject;
use \cmu\ddd\directory\infrastructure\domain\model\factory\collection\OutletsCollection;

abstract class AbstractOutlets extends AbstractSubObject
{

	abstract public function returnNormArray(array $subobjarray) : array ;

	protected function returnSelfact() : OutletsSelectionFactory
	{
		return new OutletsSelectionFactory;
	}

	protected function returnMapper(array $raw) : OutletsMapper
	{
		return new OutletsMapper($raw);
	}

	protected function getIdObjectSearchById(string $id) : OutletsIdentityObject
	{
		$idobj = new OutletsIdentityObject();
		$idobj->field("cn")->eq($id);
		return $idobj;
	}
	
}
