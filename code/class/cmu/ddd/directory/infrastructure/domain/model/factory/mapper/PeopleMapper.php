<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\config\PeopleConfig; 
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\config\AbstractConfig; 
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;

class PeopleMapper extends AbstractMapper

{

	protected function getConfig( AbstractPersistenceFactory $factory, $options) : AbstractConfig 
	{	
	//	return new $factory->getConfig($options['people']);		
		var_dump($factory);
		return $factory->getConfig($options['people']);


	}	

}
