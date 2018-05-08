<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\RoomsRepository;

class UpdateRoomsservice extends AbstractRoomsService 
{

	public function execute(DTO $dto) : bool
	{

		//we need to get the Andrewid from DN
//		$dn = $dto->get('dn');										//returns uid=jacke,ou=people,dc=mcs,dc=cmu,dc=edu
//
//		$roomid =  $this->getUid($dn);
//
//		$dto->set('roomid', $roomid);
//
//		$obj = $this->doa->build($dto);
//
//		return $this->doa->update($obj);	
		$obj = $this->doa->build($dto);

		$this->repo->addDirty($obj);

		return $this->repo->performOperations();	

	}

}	

