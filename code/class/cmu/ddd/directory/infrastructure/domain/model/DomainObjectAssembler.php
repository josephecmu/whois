<?php

namespace cmu\ddd\directory\infrastructure\domain\model;

use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\AbstractCollection;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\config\site\bin\Registry;
use cmu\wrappers\LdapWrapper;

class DomainObjectAssembler
{
	protected $factory;
	private $statments;
	protected $ldap = null;   
	public $ds;																//might be more efficient to keep the $ds handle avalailable?

	public function __construct(AbstractPersistenceFactory $factory) 
	{
		$this->factory = $factory;											//we need to determine what obj to build
		$reg = Registry::instance();
        $this->ds = LdapWrapper::getLdapDs();
        $this->ldap = new LdapWrapper($this->ds);       					 //query LDAP
	}

	public function findOne(AbstractIdentityObject $idobj): AbstractEntity
	{
		$collection = $this->find($idobj);
		return $collection->next(); 										//return only ONE (next)
	}

	public function find(AbstractIdentityObject $idobj) : AbstractCollection
	{
		$selfact = $this->factory->getSelectionFactory();              // returns PeopleSelectionFactory, etc.
		
		list ($location, $fields, $filter) = $selfact->newSelection($idobj); // creates $location, $fields, $filter
		$link = $this->ldap->search($location, $filter, $fields);

		$raw=$this->ldap->getEntries($link);
		
		$mapper = $this->factory->getMapper($raw);

		$norm_array_collection = $mapper->return_ldap_collection_array_to_domain(); 

		return $this->factory->getCollection($norm_array_collection);
	}
	//this should handle DTO object creation. 
	public function build(DTO $dto) : AbstractEntity
 	{
		//Get Mapper and convert data
		$raw = $dto->getDataArray();
		$mapper = $this->factory->getMapper($raw);
		$domain_array = $mapper->return_dto_to_domain_array();

		//get Objectfactory and return object
		$dofact = $this->factory->getDomainObjectFactory();
		$obj = $dofact->createObject($domain_array); 

		return $obj;
	}

	public function add(AbstractEntity $obj) : bool
	{
		$addfact = $this->factory->getModifyFactory();
		list($dn, $input) = $addfact->newAdd($obj);    	//get $dn and $input for ldap update() below
		return $this->ldap->add($dn, $input);
	}
	
	public function update(AbstractEntity $obj) :bool
	{
		$updatefact = $this->factory->getModifyFactory();
		list($dn, $input) = $updatefact->newUpdate($obj);    	//get $dn and $input for ldap update() below
		return $this->ldap->update($dn, $input);
	}

	public function delete(AbstractEntity $obj) : bool
	{
		$delfactory = $this->factory->getModifyFactory();
		$dn = $delfactory->newDelete($obj);		
		return $this->ldap->delete($dn);	
	}

    public function verifyUnique (AbstractIdentityObject $idobj)
    {
        $selfact = $this->factory->getSelectionFactory();              // returns PeopleSelectionFactory, etc.
        list ($location, $fields, $filter) = $selfact->newOrSelection($idobj); // creates $location, $fields, $filter

        $link = $this->ldap->search($location, $filter, $fields);
        $count = $this->ldap->countEntries($link);

        if($count > 0)
            return false;
        return true;
    }
}
