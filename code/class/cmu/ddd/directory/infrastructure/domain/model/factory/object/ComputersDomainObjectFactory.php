<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object;

use \cmu\ddd\directory\domain\model\equipment\computers\Computer;
 
class ComputersDomainObjectFactory extends AbstractDomainObjectFactory
{
	protected function getIdName() : string
	{
		return $this->options['computers']['idname'];
	}

	public function createObject(array $norm_array) : Computer
	{
		$classname = Computer::class;

		if (! $obj = $this->getFromMap($classname, $norm_array[$this->idname])) {
			$obj = new Computer($norm_array);
		}

		$this->addToMap($obj);

		return $obj;
	}

}
