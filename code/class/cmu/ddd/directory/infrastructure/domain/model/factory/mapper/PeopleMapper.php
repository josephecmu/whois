<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\config\PeopleConfig; 
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\config\AbstractConfig; 

class PeopleMapper extends AbstractMapper

{

	protected function getConfig($options) : AbstractConfig 
	{	
		return new PeopleConfig($options['people']);		

	}	

}
