<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\query\selection;

use  \cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;

class PeopleSelectionFactory extends AbstractSelectionFactory

{

	protected function getDn() : string
	{

		return "ou=people";

	}

	protected function targetClass() : string
	{

		return PeopleIdentityObject::class;

	}

}
