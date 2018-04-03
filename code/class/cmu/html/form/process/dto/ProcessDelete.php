<?php

namespace cmu\html\form\process\dto;

use cmu\ddd\directory\application\services\RunService;

class ProcessDelete extends AbstractProcess

{

	public function modify() : bool
	{

		return RunService::init($this->dto, 'delete');

	}
	
}
