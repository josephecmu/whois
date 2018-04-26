<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\PeopleRepository;

class GetPeopleService extends AbstractPeopleService 

{

	public function execute(DTO $dto) : DTO

	{
		$dn = $dto->get('dn');							//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

		$object = $this->repo->findByDn($dn);

		$dto_fact = $this->factory->getDTOFactory();

		return $dto_fact->getDTO($object);

	}

}
