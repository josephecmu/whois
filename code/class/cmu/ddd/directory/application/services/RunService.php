<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\infrastructure\services\dto\DTO;


class RunService
{

	static public function init(DTO $dto) : DTO
	{

		$action = $dto->get('action');

		$svc = CommandFactory::getCommand($action);

		$dto->unset('action');

		return $svc->execute($dto);

	}

}
