<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\RoomsDn;
use cmu\ddd\directory\domain\model\locations\Rooms;
use cmu\ddd\directory\domain\model\equipment\outlets\Outlet;
use cmu\ddd\directory\infrastructure\domain\model\idobject\RoomsIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\ddd\directory\infrastructure\domain\model\factory\RoomsPersistenceFactory;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;   
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\RoomsMapper;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\RoomsDomainObjectFactory;
use cmu\ddd\directory\infrastructure\services\dto\DTO;

class RoomsRepository extends AbstractRepository 
{

	private $action_array;

	private function getRoomNormArray(DTO $dto) : array
	{

		$raw = $dto->getDataArray();
		$mapper = new RoomsMapper($raw);
		return $mapper->return_dto_to_domain_array();
	}

	public function buildNew(DTO $dto)
	{

		$this->build($dto, 'new');

	}

	public function buildUpdate(DTO $dto)
	{
		
		$this->build($dto, 'update');

	}

	public function buildDelete(DTO $dto)
	{

		$room_norm_array = $this->getRoomNormArray($dto);

		if (isset($room_norm_array['outlets'])) {
			$outlets=$room_norm_array['outlets'];
			unset($room_norm_array['outlets']);
		}

		$room = (new RoomsDomainObjectFactory())->createObject($room_norm_array);

		$this->addDelete($room);

		if (isset($outlets)) {	

			$fact = new RoomsDomainObjectFactory;

			foreach($outlets as $outlet) {

				$room->assignOutletToRoom($outlet); //no need to normalize.
				
			}
		}	
		
		foreach ($room->getOutlets() as $obj) { 

			$this->addDelete($obj);	

		}
	
	}
	//FU  This could be broken up.
	private function build(DTO $dto, string $state) 
	
	{
	
		//get the proper function to store the Room.
		switch ($state) {
		case 'new':
			$function='addNew';
			break;
		case 'update':
			$function='addDirty';
			break;
		}

		$room_norm_array = $this->getRoomNormArray($dto);
		
		if (isset($room_norm_array['outlets'])) {
			$outlets=$room_norm_array['outlets'];
			unset($room_norm_array['outlets']);
		}

		$room = (new RoomsDomainObjectFactory())->createObject($room_norm_array);

		if (isset($outlets)) {	

			$fact = new RoomsDomainObjectFactory;

			foreach($outlets as $outlet) {

				$action = $fact->getAction($outlet);	

				$outletnormarray = $fact->returnNormOutletArray($outlet, $action);
				
				$this->action_array[$outletnormarray['outletid']] = $action;

				$room->assignOutletToRoom($outletnormarray);

			}
		}	

		if ($room->getOutlets()) {

			foreach ($room->getOutlets() as $obj) { 		

				$cur_action = $this->action_array[$obj->getOutletId()];

				switch ($cur_action) {
					case "create":			
						$this->addNew($obj);
						break;
					case "update":				
						$this->addDirty($obj);
						break;
					case "delete":
						$this->addDelete($obj);
						break;

				}	

				if ($cur_action == 'delete') {		//the subobject must be removed from the list of outlets
				
					$room->removeOutletFromRoom($obj);

				}

			}

		}

		$this->$function($room);

	}


	public function buildDn(string $id) : string
	{
	
		return RoomsDn::buildDn($id);

	}
}
