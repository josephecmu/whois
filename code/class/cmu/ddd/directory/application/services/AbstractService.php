<?php

namespace cmu\ddd\directory\application\services;
use cmu\ddd\directory\infrastructure\services\dto\DTO;

abstract class AbstractService 

{

	abstract function execute (DTO $dto);  //can return DTO(R), or can return bool (CUD)


}
