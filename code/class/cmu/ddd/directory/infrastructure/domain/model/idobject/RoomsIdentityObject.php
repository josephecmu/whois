<?php

namespace cmu\ddd\directory\infrastructure\domain\model\idobject;

class RoomsIdentityObject extends IdentityObject
{
	public function __construct(string $field = null)
	{
		parent::__construct($field, ['roomnumber']);
	}
}

