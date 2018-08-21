<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\RoomsRepository;

class DeleteRoomsService extends AbstractRoomsService 

{

	public function execute(DTO $dto) : bool

	{
		
		//$dn = $dto->get('dn');					//returns cn=WH6102,ou=rooms,dc=mcs,dc=cmu,dc=edu

		//$roomid = $this->getUid($dn);			//the roomid id SHOULD be passed via the form (bug)

		//$dto->set('roomid', $roomid);

		//$obj = $this->doa->build($dto);

		//return $this->doa->delete($obj);

//		$obj = $this->doa->build($dto);

		$this->repo->buildDelete($dto);

		return $this->repo->performOperations();	

	}

}

