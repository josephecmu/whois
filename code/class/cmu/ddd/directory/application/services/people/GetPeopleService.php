<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\PeopleRepository;

class GetPeopleService extends AbstractPeopleService 

{

	public function execute(DTO $dto) : DTO

	{
//////////////////////////////////////////////////////bug
		$dn = $dto->get('dn');							//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

		$id = $this->getId($dn); //jacke				//the andrew id SHOULD be passed via the form (bug)
//////////////////////////////////bug
		$object = (new PeopleRepository($this->doa))->findById($id);

		$dto_fact = $this->factory->getDTOFactory();

		return $dto_fact->getDTO($object);

	}

}
