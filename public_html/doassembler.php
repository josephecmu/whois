<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//glboal include
include_once '../code/class/cmu/config/site/whois.conf';

use cmu\ddd\directory\domain\model\actors\people\People;
//$factory = PersistenceFactory::getFactory(Venue::class);


//$finder = new DomainObjectAssembler($factory);


$factory = \cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory::getFactory(People::class);
$doa = new \cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler($factory);



$id = new \cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject();

$id->field("uid")
	->eq("florin");
//	->field("test2")
//	->gt("another")
//	->lt("somethingelse");


echo "<pre>";
echo "<strong> doassembler.php       ->find return Collection </strong>";
echo "<br />";
print_r($doa->find($id));

echo "<strong> doassembler.php     ->findOne  Returns a hydrated object</strong>";
echo "<br />";
$object = $doa->findOne($id);
print_r($object);

////print_r($id);
//$psf = new \cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\PeopleSelectionFactory;
////print_r($psf->newSelection($id)); 
////
////
////
////NOW LETS CONFIGURE IT FOR AN LDAP ARRAY
////
////
echo $doa->add($object);
//
//echo "from DTO to Domain array";
//echo "<br />";  
////we need a DTO
//echo "DTO-------------------------";
//echo "<br />";
//
echo "Now to DTO.............";
echo "<br />";  
$dto_fact = $factory->getDTOFactory();
$dto = $dto_fact->getDTO($object);
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
echo "<strong>domain array from AbstractMapper::return_dto_to_domain_array()::</strong>";
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
echo "<strong>now we can build objects directly from DTO with DomainObjectAssembler::build()</strong>";
echo "<br />";
$obj = $doa->build($dto);
//
print_r($obj);
//
//
echo "</pre>";

echo "Object to DOA (first print object)";
echo "<pre>";
print_r($object);
echo "</pre>";

function object_to_array($obj) : array
{

    function obj_to_arr ($obj) {
        if(is_object($obj)) {
            $obj = (array) $obj;
        }
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = obj_to_arr($val);   //recursive function
            }
        } else {
            $new = $obj;
        }
        return $new;
    };

    return obj_to_arr($obj);

}

$converted = object_to_array($object);
echo "<pre>";
echo print_r($converted);
echo "</pre>";
$mapper = new \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\PeopleMapper($converted);
echo "dto array from AbstractMapper::return_object_to_dto()::";
echo "<br />";
$dto_array = $mapper->return_object_to_dto();
echo "<pre>";
print_r($dto_array);
echo "</pre>";

echo "build dto obj froma array";
$dto = new \cmu\ddd\directory\infrastructure\domain\model\dto\DTO($dto_array);
echo "<pre>";
echo print_r($dto);
echo "</pre>";



