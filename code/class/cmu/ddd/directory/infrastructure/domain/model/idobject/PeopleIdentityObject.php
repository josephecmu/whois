<?php

namespace cmu\ddd\directory\infrastructure\domain\model\idobject;

class PeopleIdentityObject extends IdentityObject
{
	public function __construct(string $field = null)
	{
		parent::__construct($field, ['sn','cn','uid','mail','employeetype']);  //<-these are LDAP attributes, have to be as this filters return LDAP attributes
	}
}
