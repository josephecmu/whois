<?php

//glboal include

    include_once '../code/class/cmu/config/site/whois.conf';

//$doa = new \cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;

$id = new \cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject();

$id->field("test")
	->eq("something")
	->field("test2")
	->gt("another")
	->lt("somethingelse");

//print_r($id);

$psf = new \cmu\ddd\directory\infrastructure\domain\model\factory\query\selection\PeopleSelectionFactory;

print_r($psf->newSelection($id)); 


