<?php

namespace cmu\ddd\directory\application\services\rooms;

use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\repository\RoomsRepository;

class AddRoomsService extends AbstractRoomsService

{

	public function execute(DTO $dto) : bool

	{

		$dto->unset('ou'); 					//this administrative key is not needed here.


		$roomid = $dto->get('roomid');

		$dn = $this->repo->buildDn($roomid);		//get the ID from the repo
		$dto->set('dn', $dn);						//we need to pass the $dn we just constructed
		$obj = $this->doa->build($dto);				//build the object

		$this->repo->addNew($obj);
		return $this->repo->performOperations();	

	}

}

