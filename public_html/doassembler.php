<?php

//glboal include
include_once '../code/class/cmu/config/site/whois.conf';

use cmu\ddd\directory\domain\model\actors\people\People;
//$factory = PersistenceFactory::getFactory(Venue::class);

$factory = \cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory::getFactory(People::class);

//$finder = new DomainObjectAssembler($factory);


$id = new \cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject();

$id->field("uid")
	->eq("josephe");
//	->field("test2")
//	->gt("another")
//	->lt("somethingelse");

$doa = new \cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler($factory);

echo "<pre>";
echo "<strong> doassembler.php       ->find return Collection </strong>";
echo "<br />";
print_r($doa->find($id));

echo "<strong> doassembler.php     ->findOne  Returns a hydrated object</strong>";
echo "<br />";
$object = $doa->findOne($id);
print_r($object);





////print_r($id);
////$psf = new \cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\PeopleSelectionFactory;
////print_r($psf->newSelection($id)); 
////
////
////
////NOW LETS CONFIGURE IT FOR AN LDAP ARRAY
////
////
//echo $doa->insert($object);
//
//echo "from DTO to Domain array";
//echo "<br />";  
////we need a DTO
//echo "DTO-------------------------";
//echo "<br />";
//
echo "Now to DTO.............";
echo "<br />";  
$dto_fact = $factory->getDTOFactory($object);
$dto = $dto_fact->getDTO();
print_r($dto);
//
//
//
//
//
$mapper = new \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\PeopleMapper($dto->getDataArray());
//echo "MAPPER";
//echo "<br />";  
//print_r($mapper);
//
//echo"-----------OBJECT--------------------------------";
//echo "<br />";
//print_r($object);
//
echo "domain array from AbstractMapper::return_dto_to_domain_array()::";
echo "<br />";
$domain_array=$mapper->return_dto_to_domain_array();
//print_r($domain_array);
//
//
$people = new People($domain_array);
//echo "People Object";
//echo "<br />";
print_r($people);
//
//
//echo "now we can build objects directly from DTO with DomainObjectAssembler::build()";
//
//$obj = $doa->build($dto);
//
//print_r($obj);
//
//
echo "</pre>";
