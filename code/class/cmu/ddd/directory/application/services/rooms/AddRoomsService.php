<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\RoomsDn;

class AddRoomsService extends AbstractRoomsService

{

	public function execute(DTO $dto) : bool

	{
		$ou_eq = $dto->get('ou');			//the DTO for 'ADD' contains the key 'ou'

		$dto->unset('ou'); 					//this administrative key is not needed here.

		$roomid = $dto->get('roomid');

		$dn = RoomsDn::buildDn($roomid);

		$dto->set('dn', $dn);		//we need to pass the $dn we just constructed

		$obj = $this->doa->build($dto);

		return $this->doa->add($obj);	

	}

}

