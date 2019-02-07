<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;
//use cmu\config\site\bin\Conf;

class PeopleSelectionFactory extends AbstractSelectionFactory
{
	protected function getOu() : string
	{
		return $this->options['people']['dnprefix'];
	}
}
