<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;

class UpdateRoomsservice extends AbstractRoomsService 
{

	public function execute(DTO $dto) : bool
	{

		//we need to get the Andrewid from DN
		$dn = $dto->get('dn');										//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu

		$roomid =  $this->getUid($dn);

		$dto->set('roomid', $roomid);

		$obj = $this->doa->build($dto);

		return $this->doa->update($obj);	

	}

}	

