<?php

namespace cmu\ddd\directory\application\services\people;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class GetPeopleService extends AbstractPeopleService 
{
	public function execute(DTO $dto) : DTO
	{
		$dn = $dto->get('dn');							//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu
		$andrewid = ldap_explode_dn($dn, 1)[0];		//we have to find by $id, can't search currently with DN
		$this->idobj->field("uid")->eq($andrewid);
		$object = $this->repo->getObj($this->idobj);
		$dto_fact = $this->factory->getDTOFactory();
		return $dto_fact->getDTO($object);
	}
}
