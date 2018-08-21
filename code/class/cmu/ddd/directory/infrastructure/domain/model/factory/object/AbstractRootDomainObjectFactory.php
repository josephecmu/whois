<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

abstract class AbstractRootDomainObjectFactory extends AbstractDomainObjectFactory 
{

	abstract protected function getAction(array $subobjarray) : string; 

}
