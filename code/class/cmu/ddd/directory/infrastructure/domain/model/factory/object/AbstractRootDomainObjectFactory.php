<?php
/*
 *Used ONLY for AGGREGATE ROOTS
 */
namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

abstract class AbstractRootDomainObjectFactory extends AbstractDomainObjectFactory 
{
	abstract public function createObject(array $norm_array);		//no return type, children can do that.
	abstract protected function getAction(array $subobjarray) : string; 
}
