<?php

namespace cmu\ddd\directory\application\services\computers;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class GetComputersService extends AbstractComputersService 
{
	public function execute(DTO $dto) : DTO
	{
		$dn = $dto->get('dn');							//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu
		$computerid = ldap_explode_dn($dn, 1)[0];		//we have to find by $id, can't search currently with DN
		$this->idobj->field("cn")->eq($computerid);
		$object = $this->repo->getObj($this->idobj);
		$dto_fact = $this->factory->getDTOFactory();
		return $dto_fact->getDTO($object);
	}
}
