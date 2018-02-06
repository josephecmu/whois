<?php

namespace cmu\ddd\directory\infrastructure\domain\model;

use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\idobject\IdentityObject;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\collection\AbstractCollection;

class DomainObjectAssembler

{
	private $statments;
	protected $ldap = null;   
	public $ds;		//might be more efficient to keep the $ds handle avalailable?

	/* listing 13.48 */
   //$factory = PersistenceFactory::getFactory(Venue::class);
   //$finder = new DomainObjectAssembler($factory);
	public function __construct(AbstractPersistenceFactory $factory) {
		$this->factory = $factory;
		$reg = \cmu\config\site\bin\Registry::instance();
		//		$this->ldap = $reg->getLdap();    //Z uses registy, I will create new instance below

        $this->ds = \cmu\wrappers\LdapWrapper::getLdapDs();

        $this->ldap = new \cmu\wrappers\LdapWrapper($this->ds);        //query LDAP
		
	}

	private function getStatement()
	{	
//	//This will need to change, LdapWrapper has no prepare() method...no PDOStatement to return	
//	{
//		if (! isset($this->statements[$str])) {
//			$this->statements[$str] = $this->ldap->prepare($str);
//		}
//
//		return $this->statements[$str];
        $this->ldap = new \cmu\wrappers\LdapWrapper(static::$ds);        //query LDAP
	}

	public function findOne(IdentityObject $idobj): AbstractEntity
	{
		$collection = $this->find($idobj);
		return $collection->next(); 		//return  only ONE (next)
	}

	public function find(IdentityObject $idobj) : AbstractCollection
	{
		$selfact = $this->factory->getSelectionFactory();              // returns PeopleSelectionFactory, etc.
		list ($location, $fields, $filter) = $selfact->newSelection($idobj); // creates $location, $fields, $filter
		$link = $this->ldap->search($location, $filter, $fields);

		$raw=$this->ldap->getEntries($link);

		//mapper here for LDAP records...
		$mapper = $this->factory->getMapper($raw);
		$norm_array_collection = $mapper->return_ldap_collection_array_to_domain(); 

		return $this->factory->getCollection($norm_array_collection);
	}
	
	//I created...
	//we need a way to build a Domain Object for insert()
	//pass a Data Transfer Object (request)
	//however we have TWO types of array, 
	//1- form submission -> dto -> array
	//2- Params -> LDAP return (find(), above)
	public function build(   ) :  AbstractEntity
 	{

		//this should handle form submission object creation. 

	}

	public function insert(AbstractEntity $obj)
	{

		$upfact = $this->factory->getUpdateFactory();

		//not finished..........................................
		list($rdn, $input) = $upfact->newUpdate($obj);


		//WHERE SHOULD THE MAPPER GO??????

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

		//not finished

	}
	
}
