<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\object\subobject;

use cmu\wrappers\LdapWrapper;
use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;  
use cmu\ddd\directory\infrastructure\domain\model\factory\object\AbstractDomainObjectFactory;
use \cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;

abstract class AbstractSubObject extends AbstractDomainObjectFactory
{

	protected $ldap;
	protected $select_factory;
	protected $mapper;
	protected $fact;

	abstract public function returnNormArray(array $subobjarray) : array ;
	abstract protected function targetClass() : string;
	abstract protected function getIdObjectSearchById(string $id) : AbstractIdentityObject;

	function __construct()
	{
		$this->fact = $this->getFactory($this->targetClass());
		$this->setLdapHandle();
		$this->select_factory = $this->fact->getSelectionFactory();
	}

	private function getFactory($class) : AbstractPersistenceFactory
	{
		return AbstractPersistenceFactory::getFactory($class);	
	}
	//this can be optimized - this is called each time the class is instantiated FU
	protected function setLdapHandle() : void
	{
		$ds = LdapWrapper::getLdapDs();
		$this->ldap = new LdapWrapper($ds);        //query LDAP
	}

	protected function returnRawArrayFromIdobject(AbstractIdentityObject $idobj) : array
	{
		list ($location, $fields, $filter) = $this->select_factory->newSelection($idobj); 
		$link = $this->ldap->search($location, $filter, $fields);
		return $this->ldap->getEntries($link);
	}

	protected function returnSingleNormArrayLdapToDomain(array $raw) : array   //return ONE record
	{
		$mapper = $this->fact->getMapper($raw);
		return $mapper->return_ldap_array_to_domain(); 
	}
}
