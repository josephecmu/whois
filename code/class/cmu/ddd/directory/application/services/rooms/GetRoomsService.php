<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\idobject\RoomsIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\RoomsRepository;

class GetRoomsService extends AbstractRoomsService 

{

	public function execute(DTO $dto) : DTO

	{

//		$dn = $dto->get('dn');					//returns cn=WH6102,ou=rooms,dc=mcs,dc=cmu,dc=edu
//
//		$cn = $this->getUid($dn);			// we have a cn as the Unique Identifier 	
//
//		$id = new RoomsIdentityObject();
//		$id->field("cn")
//			->eq($cn);
//
//		$this->doa->find($id);
//		$object = $this->doa->findOne($id);
//
//		$dto_fact = $this->factory->getDTOFactory();

//		return $dto_fact->getDTO($object);

		$dn = $dto->get('dn');							//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

		$object = $this->repo->findByDn($dn);

		$dto_fact = $this->factory->getDTOFactory();

		return $dto_fact->getDTO($object);

	}

}
