<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\outlets;

use cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject\AbstractSubObject;
use cmu\ddd\directory\domain\model\equipment\outlets\Outlet; 
use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;  

abstract class AbstractOutlets extends AbstractSubObject
{
	protected function targetClass() : string
	{   
		return Outlet::class;
    }		

	protected function getIdName() : string
	{
		return $this->options['outlets']['idname'];
	}

	protected function getIdObjectSearchById(string $id) : AbstractIdentityObject
	{
		$idobj = $this->fact->getIdentityObject();
		$idobj->field("cn")->eq($id);
		return $idobj;
	}
}
