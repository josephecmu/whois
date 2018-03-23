<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\infrastructure\services\dto\DTO;


class RunService
{

	static public function init(DTO $dto, string $action) : DTO
	{

		$svc = CommandFactory::getCommand($action);

		return $svc->execute($dto, $action);

	}

}
