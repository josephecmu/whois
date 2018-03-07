<?php

//glboal include

    include_once '../code/class/cmu/config/site/whois.conf';

use cmu\ddd\directory\domain\model\actors\people\People;
//$factory = PersistenceFactory::getFactory(Venue::class);

$factory = \cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory::getFactory(People::class);

//$finder = new DomainObjectAssembler($factory);


$id = new \cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject();

$id->field("uid")
	->eq("florin");
//	->field("test2")
//	->gt("another")
//	->lt("somethingelse");

$doa = new \cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler($factory);

echo "->find";
echo "<pre>";
print_r($doa->find($id));
echo "</pre>";

//echo "->findOne  Returns a hydrated object";
$object = $doa->findOne($id);
echo "<pre>";
print_r($object);
echo "</pre>";
//print_r($id);
//$psf = new \cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\PeopleSelectionFactory;
//print_r($psf->newSelection($id)); 
//
//
//
//NOW LETS CONFIGURE IT FOR AN LDAP ARRAY
//
//
echo $doa->insert($object);

echo "from DTO to Domain array";
echo "<br />";  
//we need a DTO
echo "DTO-------------------------";
echo "<br />";

$array=[
		'firstname' => 'Joe',
		 'lastname' => 'Evans',
		    'email' => ['josephe@andrew.cmu.edu', 'secondemail@gmail.com']
		];


$dto = new \cmu\ddd\directory\infrastructure\domain\model\dto\DTO($array);	
echo "<pre>";
print_r($dto);

$mapper = new \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\PeopleMapper($dto->getDataArray());

print_r($mapper);



echo "domain array from AbstractMapper::return_dto_to_domain_array()::";
echo "<br />";
$domain_array=$mapper->return_dto_to_domain_array();
print_r($domain_array);


$people = new People($domain_array);

print_r($people);
echo "</pre>";
