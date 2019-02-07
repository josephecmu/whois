<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

//use cmu\config\site\bin\Conf;

class OutletsSelectionFactory extends AbstractSelectionFactory
{
	protected function getOu() : string
	{
		return $this->options['outlets']['dnprefix'];
	}
}

