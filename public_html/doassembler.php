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

echo "->findOne  Returns a hydrated object";
echo "<pre>";
print_r($doa->findOne($id));
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
$object = $doa->findOne($id);
//print_r($doa->findOne($id));
$doa->insert($object);
