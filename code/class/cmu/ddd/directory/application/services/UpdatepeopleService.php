<?php

namespace cmu\ddd\directory\application\services;

use cmu\ddd\directory\domain\model\actors\people\People;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;

class Updatepeopleservice extends AbstractService
{

	public function execute(DTO $dto) : bool
	{

		$factory = AbstractPersistenceFactory::getFactory(People::class);	
		$doa = new DomainObjectAssembler($factory);

		////some checking confirming the a userID does not already exist	
		//identity generator reference here??????
		//also check for existance of gidnumber and uidnumber and homedirectory

		//we need to get the Andrewid from DN
		$dn = $dto->get('dn');					//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu
    	$andrewid = substr(substr($dn, 0, strpos( $dn, ',', 0)), 4);        //get to first comma, then strip 'uid='

		$dto->set('andrewid', $andrewid);

		$obj = $doa->build($dto);

		return $doa->update($obj);	

	}

}	
