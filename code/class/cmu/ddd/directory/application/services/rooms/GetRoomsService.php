<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\idobject\RoomsIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\RoomsRepository;

class GetRoomsService extends AbstractRoomsService 

{

	public function execute(DTO $dto) : DTO

	{

		$dn = $dto->get('dn');					//returns cn=WH6102,ou=rooms,dc=mcs,dc=cmu,dc=edu

		$cn = ldap_explode_dn($dn, 1)[0]; 

		$dto->set('action', 'get');

		//check repository if object already exists...


		//this could go in the repository
		$id = new RoomsIdentityObject();
		$id->field("cn")
			->eq($cn);

		$obj = $this->doa->findOne($id);

		$dto_fact = $this->factory->getDTOFactory();

		return $dto_fact->getDTO($obj);


	}

}
