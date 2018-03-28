<?php

namespace cmu\html\form\process\dto;

use cmu\ddd\directory\application\services\RunService;

class ProcessAdd extends AbstractProcess

{

	public function modify() : bool
	{

		return RunService::init($this->dto, 'add');

	}

}
