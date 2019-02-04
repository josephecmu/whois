<?php

namespace cmu\ddd\directory\application\services\computers;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\idobject\ComputersIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\ComputersRepository;

class GetComputersService extends AbstractComputersService 

{
//must mod for computers.......................
	public function execute(DTO $dto) : DTO

	{
		$dn = $dto->get('dn');							//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

		$computerid = ldap_explode_dn($dn, 1)[0];		//we have to find by $id, can't search currently with DN

		$id = new ComputersIdentityObject();

		$id->field("cn")->eq($computerid);

		$object = $this->repo->getObj($id);
	
		$dto_fact = $this->factory->getDTOFactory();

		return $dto_fact->getDTO($object);

	}

}
