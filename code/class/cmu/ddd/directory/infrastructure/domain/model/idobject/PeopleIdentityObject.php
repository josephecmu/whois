<?php

namespace cmu\ddd\directory\infrastructure\domain\model\idobject;

class PeopleIdentityObject extends IdentityObject
{
	public function __construct(string $field = null)
	{
		parent::__construct($field, ['sn','cn','uid']);  //<-these are LDAP attributes
	}
}
