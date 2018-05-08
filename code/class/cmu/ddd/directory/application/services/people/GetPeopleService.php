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

		///check if in repository

		$andrewid = ldap_explode_dn($dn, 1)[0];		//we have to find by $id, can't search currently with DN

		$id = new PeopleIdentityObject();

		$id->field("uid")->eq($andrewid);
		$this->doa->find($id);
		$object = $this->doa->findOne($id);
		$dto_fact = $this->factory->getDTOFactory();

		return $dto_fact->getDTO($object);

	}

}
