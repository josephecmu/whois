<?php


//glboal include

 include_once '../code/class/cmu/config/site/whois.conf';


 use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\PeopleMapper;

	 $array =  ['cn'=>'joe',

		 'new' => ['sn'=>'evans']
		 
		 		];

 $mapper = new PeopleMapper($array);

// $mapper->remap();


 print_r($mapper->returnArrayKey());
echo "<pre>";
//print_r($mapper->returnArrayFinal());
print_r($mapper->return_array_to_domain());
echo "</pre>";
