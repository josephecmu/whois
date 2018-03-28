<?php

namespace cmu\ddd\directory\infrastructure\domain\model\share;

trait TraitTargetClass
{
	
	abstract protected function targetClass() : string;

	protected function verifyTargetClass($obj)
	{
		 $class = $this->targetClass();							//concrete implimentation

		 if (! ($obj instanceof $class )) {
			 throw new \Exception("This should be a {$class} object");

		 }

	 }

}
