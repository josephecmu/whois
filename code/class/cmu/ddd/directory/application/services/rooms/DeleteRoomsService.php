<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class DeleteRoomsService extends AbstractRoomsService 

{

	public function execute(DTO $dto) : bool

	{
		
		$dn = $dto->get('dn');					//returns uid=jacke,ou=rooms,dc=mcs,dc=cmu,dc=edu

		$roomid = $this->getUid($dn);			//the andrew id SHOULD be passed via the form (bug)

		$dto->set('roomid', $roomid);

		$obj = $this->doa->build($dto);

		return $this->doa->delete($obj);

	}

}

