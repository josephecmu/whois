<?php

namespace cmu\html\form\process\dto;

use cmu\ddd\directory\application\services\RunService;

class ProcessUpdate extends AbstractProcess

{
	public function modify() : bool
	{

		return RunService::init($this->dto, 'update');

	}
}
