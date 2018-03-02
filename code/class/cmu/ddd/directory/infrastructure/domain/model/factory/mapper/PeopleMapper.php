<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\config\PeopleConfig; 
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\config\AbstractConfig; 

class PeopleMapper extends AbstractMapper

{

//	protected function getConfig() : AbstractConfig
//	{
//		
//		//var_dump($this->options['people']);
//
//		var_dump($this->factory);
//
//		var_dump($this->factory->getConfig($this->options['people']));
//		
//		return $this->factory->getConfig($this->options['people']);
//
//	}

	protected function getConfig($options) : AbstractConfig 
	{	
		//return $factory->getConfig($options['people']);
		return new PeopleConfig($options['people']);		

	}	


}
