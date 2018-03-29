<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;

class DeletepeopleService extends AbstractService 

{

	public function execute(DTO $dto) : bool

	{
		
		$factory = AbstractPersistenceFactory::getFactory(People::class);	
		$doa = new DomainObjectAssembler($factory);

		//add the andrewid


		$dn = $dto->get('dn');					//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu
    	$andrewid = substr(substr($dn, 0, strpos( $dn, ',', 0)), 4);        //get to first comma, then strip 'uid='

		$dto->set('andrewid', $andrewid);

		$obj = $doa->build($dto);

		return $doa->delete($obj);

	}

}
