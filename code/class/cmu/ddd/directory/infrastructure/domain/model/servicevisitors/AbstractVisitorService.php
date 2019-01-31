<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\servicevisitors; 
/////CAN WE DELETE?????????????????????????????????????????????????
use cmu\ddd\directory\application\services\people\AddPeopleService;
use cmu\ddd\directory\application\services\AbstractService;

abstract class AbstractVisitorService

{

	static $dc = "dc=mcs,dc=cmu,dc=edu"; 

	abstract public function visit(AbstractService $entity);

	public function visitAddPeopleService(AddPeopleService $entity)
	{
		$this->visit($entity);
	}	


}
