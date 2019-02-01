<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use \cmu\ddd\directory\domain\model\equipment\outlets\Outlet;
use \cmu\ddd\directory\domain\model\locations\Rooms;
use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\RoomsDn;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\RoomsMapper;
use cmu\ddd\directory\infrastructure\domain\model\factory\object\RoomsDomainObjectFactory;
use cmu\ddd\directory\infrastructure\services\dto\DTO;

class RoomsRepository extends AbstractRepository 
{

	private $action_array;

	public function buildDn(string $id) : string
	{
		return RoomsDn::buildDn($id);
	}

	private function getRoomNormArray(DTO $dto) : array
	{
		$raw = $dto->getDataArray();
		$mapper = new RoomsMapper($raw);
		return $mapper->return_dto_to_domain_array();
	}

	public function buildNew(DTO $dto) : void
	{
		$this->build($dto, 'new');
	}

	public function buildUpdate(DTO $dto) : void
	{
		$this->build($dto, 'update');
	}

	public function buildDelete(DTO $dto) : void
	{
		$room_norm_array = $this->getRoomNormArray($dto);

		if (isset($room_norm_array['outlets'])) {
			$outlets=$room_norm_array['outlets'];
			unset($room_norm_array['outlets']);
		}

		$room = (new RoomsDomainObjectFactory())->createObject($room_norm_array);

		$this->addDelete($room);

		if (!empty($outlets)) {	

			$fact = new RoomsDomainObjectFactory;

			foreach($outlets as $outlet) {
				$outletnormarray = $fact->returnNormOutletArray($outlet, 'delete');
				$room->assignOutletToRoom($outletnormarray); //no need to normalize.
			}
		}	
		
		foreach ($room->getOutlets() as $obj) { 
			$this->addDelete($obj);	
		}
	}

	private function build(DTO $dto, string $state) : void
	{
		$function = $this->getAddNewOrDirtyFunction($state);

		$room_norm_array = $this->getRoomNormArray($dto);   //runs through the mapper listed above

		if (!empty($room_norm_array['outlets'])) {			//strip the outlets if they exist.
			$outlets=$room_norm_array['outlets'];
			unset($room_norm_array['outlets']);
		}

		$room = (new RoomsDomainObjectFactory())->createObject($room_norm_array);	//final $room

		if (!empty($outlets)) {														//add the outlets to room.
			$fact = new RoomsDomainObjectFactory;
			$this->addOutletsToRoom($outlets, $fact, $room);
		}	

		if ($room->getOutlets()) {
			foreach ($room->getOutlets() as $obj) { 		
				$cur_action = $this->action_array[$obj->getOutletId()];
				$this->addObjToProperty($cur_action, $obj);
				if ($cur_action == 'delete') {		//the subobject must be removed from the list of outlets
					$room->removeOutletFromRoom($obj);
				}
			}
		}
		$this->$function($room);		//AddNewOrDirty
	}

	private function getAddNewOrDirtyFunction(string $state) : string  	//get the proper function to store the Room.
	{
		switch ($state) {
		case 'new':
			return 'addNew';
		case 'update':
			return 'addDirty';
		}
	}

	private function addObjToProperty(string $cur_action, Outlet $obj) : void
	{
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
	}

	private function addOutletsToRoom (array $outlets, RoomsDomainObjectFactory $roomfact, Rooms $room) : void
	{
		foreach($outlets as $outlet) {
			$action = $roomfact->getAction($outlet);	
			$outletnormarray = $roomfact->returnNormOutletArray($outlet, $action);
			$this->action_array[$outletnormarray['outletid']] = $action;
			$room->assignOutletToRoom($outletnormarray);
		}
	}
}
