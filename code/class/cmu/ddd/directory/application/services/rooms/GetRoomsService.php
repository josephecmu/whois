<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class GetRoomsService extends AbstractRoomsService 
{
	public function execute(DTO $dto) : DTO
	{
		$dn = $dto->get('dn');					//returns cn=WH6102,ou=rooms,dc=mcs,dc=cmu,dc=edu
		$cn = ldap_explode_dn($dn, 1)[0]; 
		$dto->set('action', 'get');
		$this->idobj->field("cn")->eq($cn);
		$obj = $this->repo->getObj($this->idobj);
		$dto_fact = $this->factory->getDTOFactory();
		return $dto_fact->getDTO($obj);
	}
}
