<?php

namespace cmu\ddd\directory\infrastructure\domain\model;

use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\idobject\AbstractIdentityObject;
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
	public $ds;									//might be more efficient to keep the $ds handle avalailable?


   //$factory = PersistenceFactory::getFactory(Venue::class);
   //$finder = new DomainObjectAssembler($factory);
	public function __construct(AbstractPersistenceFactory $factory) {
		$this->factory = $factory;											//we need to determine what obj to build

		$reg = Registry::instance();

        $this->ds = LdapWrapper::getLdapDs();

        $this->ldap = new LdapWrapper($this->ds);        //query LDAP
	
	}

	public function findOne(AbstractIdentityObject $idobj): AbstractEntity
	{

		$collection = $this->find($idobj);
		return $collection->next(); 		//return  only ONE (next)
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

	public function insert(AbstractEntity $obj)
	{

		$upfact = $this->factory->getUpdateFactory();

		list($rdn, $input) = $upfact->newUpdate($obj);    	//get $rdn and $input for ldap update() below

		echo "<br />";
		echo "<strong>INPUT for LDAP array</strong>";
		echo "<br />";
		print_r($input);
		echo "<br />";
		echo "<br />";


		// UPDATE
		//$link = $this->ldap->update($location, $filter, $fields);  <- from function above
		//		below LdapWrapper::update() is from line 115 LdapWrapper()
//		$link = $this->ldap->update($rdn, $input);

//		$stmt = $this->getStatement($update);
//		$stmt->execute($values);
//
//		if ($obj->getId() < 0) {
//			$obj->setId((int)$this->pdo->lastInsertId());
//		}
//
//		$obj->markClean();	

	}
	
}
