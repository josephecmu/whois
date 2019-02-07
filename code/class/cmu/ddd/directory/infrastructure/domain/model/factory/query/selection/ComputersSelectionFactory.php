<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

//use cmu\config\site\bin\Conf;

class ComputersSelectionFactory extends AbstractSelectionFactory
{
	protected function getOu() : string
	{
		return $this->options['computers']['dnprefix'];
	}
}
