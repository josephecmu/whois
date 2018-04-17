<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class DeletePeopleService extends AbstractPeopleService 

{

	public function execute(DTO $dto) : bool

	{
		
		$dn = $dto->get('dn');					//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

		$andrewid = $this->getId($dn);			//the andrew id SHOULD be passed via the form (bug)

		$dto->set('andrewid', $andrewid);

		$obj = $this->doa->build($dto);

		return $this->doa->delete($obj);

	}

}
