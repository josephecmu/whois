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

	private $action_array;							//stores an array of Outlets with associated action.

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
		$this->build($dto, 'delete');
	}

	private function build(DTO $dto, string $state) : void
	{
		$function = $this->getAddNewDirtyDeleteFunction($state);

		$room_norm_array = $this->getRoomNormArray($dto);   //runs through the mapper listed above

		if (!empty($room_norm_array['outlets'])) {			//strip the outlets if they exist.
			$outlets=$room_norm_array['outlets'];
			unset($room_norm_array['outlets']);
		}

		$room = $this->buildRoom($room_norm_array);

		if (!empty($outlets)) {														//add the outlets to room.
			$fact = new RoomsDomainObjectFactory;
			$this->assignMultipleOutletsToRoom($outlets, $fact, $room);
		}	

		$deleteall = ($state == 'delete') ? 'deleteall' : null;
		if ($room->getOutlets()) {						//cycle through current rooms outlets and add AddDirtyDelete
			$this->handleCurrentRoomOutlets($room, $deleteall);			
		}

		$this->$function($room);		//run AddNewOrDirty
	}

	private function getAddNewDirtyDeleteFunction(string $state) : string  	//get the proper function to store the Room.
	{
		switch ($state) {
		case 'new':
			return 'addNew';
		case 'update':
			return 'addDirty';
		case 'delete':
			return 'addDelete';
		}
	}

	private function assignMultipleOutletsToRoom (array $outlets, RoomsDomainObjectFactory $roomfact, Rooms $room) : void
	{
		foreach($outlets as $outlet) {
			$action = $roomfact->getAction($outlet);	
			$outletnormarray = $roomfact->returnNormOutletArray($outlet, $action);
			$this->action_array[$outletnormarray['outletid']] = $action;
			$room->assignOutletToRoom($outletnormarray);
		}
	}

	private function buildRoom(array $room_norm_array) : Rooms
	{
		return (new RoomsDomainObjectFactory())->createObject($room_norm_array);
	}

	private function addObjToNewDirtyDelete(string $cur_action, Outlet $obj) : void
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

	private function handleCurrentRoomOutlets(Rooms $room, string $deleteall=null ) : void
	{
		foreach ($room->getOutlets() as $obj) { 		
			if (!empty($deleteall)) {
				$this->addDelete($obj);				//this eliminates flagging each outlet as 'delete'
			} else {
				$cur_action = $this->action_array[$obj->getOutletId()];
				$this->addObjToNewDirtyDelete($cur_action, $obj);
				if ($cur_action == 'delete') {		//the subobject must be removed from the list of outlets
					$room->removeOutletFromRoom($obj);
				}
			}
		}
	}
}
