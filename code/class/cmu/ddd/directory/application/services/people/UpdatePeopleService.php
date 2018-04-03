<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class UpdatePeopleservice extends AbstractPeopleService 
{

	public function execute(DTO $dto) : bool
	{

		//we need to get the Andrewid from DN
		$dn = $dto->get('dn');										//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

		$andrewid =  $this->getUid($dn);

		$dto->set('andrewid', $andrewid);

		$obj = $this->doa->build($dto);

		return $this->doa->update($obj);	

	}

}	
