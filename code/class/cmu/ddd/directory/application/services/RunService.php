<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class RunService
{

	static public function init(DTO $dto, string $action) //may return a DTO, may return a bool
	{

		$entity = EntitySelector::getEntity($dto, $action);

        $namespace = "\\cmu\\ddd\\directory\\application\\services\\";

		$class = $namespace .  $entity . "\\" .  ucfirst($action) . ucfirst($entity)  . "Service";

        $cmd = new $class();

        return $cmd->execute($dto);

	}

}
