<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

//use cmu\config\site\bin\Conf;

class RoomsSelectionFactory extends AbstractSelectionFactory
{
	protected function getOu() : string
	{
		return $this->options['rooms']['dnprefix'];
	}
}
