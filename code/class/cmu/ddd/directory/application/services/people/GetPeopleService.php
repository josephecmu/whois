<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\idobject\PeopleIdentityObject;

class GetPeopleService extends AbstractPeopleService 

{

	public function execute(DTO $dto) : DTO

	{

		$dn = $dto->get('dn');					//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

		$uid = $this->getUid($dn);				//the andrew id SHOULD be passed via the form (bug)

		$id = new PeopleIdentityObject();
		$id->field("uid")
			->eq($uid);

		$this->doa->find($id);
		$object = $this->doa->findOne($id);

		$dto_fact = $this->factory->getDTOFactory();

		return $dto_fact->getDTO($object);

	}

}
