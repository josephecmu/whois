<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject;

use cmu\wrappers\LdapWrapper;
use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;  
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors\LdapToDomainConverter;

abstract class AbstractSubObject
{

	protected $ldap;

	abstract protected function returnSelfact();

	abstract protected function returnMapper(array $array);

	abstract protected function getIdObjectSearchById(string $id);

	function __construct()
	{
		$this->setLdapHandle();
	}
	//this can be optimized - this is called each time the class is instantiated FU
	protected function setLdapHandle() : void
	{
		$ds = LdapWrapper::getLdapDs();
		$this->ldap = new LdapWrapper($ds);        //query LDAP
	}

	protected function returnRawArrayFromIdobject(AbstractIdentityObject $idobj) : array
	{
		list ($location, $fields, $filter) = $this->returnSelfact()->newSelection($idobj); 
		$link = $this->ldap->search($location, $filter, $fields);
		return $this->ldap->getEntries($link);
	}

	protected function returnSingleNormArrayLdapToDomain(array $raw) : array   //return ONE record
	{
		return $this->returnMapper($raw)->return_ldap_array_to_domain(); 

	}

}
