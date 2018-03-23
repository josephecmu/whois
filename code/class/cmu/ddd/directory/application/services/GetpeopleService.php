<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;

class GetpeopleService extends AbstractService 

{

	public function execute(DTO $dto, string $action) : DTO

	{
		
		//we need a search key 
		$dn = $dto->get('dn');					//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

    	$uid = substr(substr($dn, 0, strpos( $dn, ',', 0)), 4);        //get to first comma, then strip 'uid='

		$factory = AbstractPersistenceFactory::getFactory(People::class);	
		$doa = new DomainObjectAssembler($factory);

		$id = new PeopleIdentityObject();

		$id->field("uid")
			->eq($uid);

		$doa->find($id);
		$object = $doa->findOne($id);

		$dto_fact = $factory->getDTOFactory();

		return $dto_fact->getDTO($object);

	}

}
