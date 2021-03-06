<?php
//This handles and agregate, a Trait  or Abs Class may be required if we have more entities of this type.
namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\domain\model\equipment\outlets\Outlet;
use cmu\ddd\directory\domain\model\locations\Rooms;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\infrastructure\domain\model\factory\AbstractPersistenceFactory;   

class RoomsRepository extends AbstractRepository 
{

	private $action_array;							//stores an array of Outlets with associated action.
	private $dofact;

	function __construct()
	{
		parent::__construct();			
		$this->dofact = $this->fact->getDomainObjectFactory();	
	}

	protected function getIdName() : string
    {   
		return $this->options['rooms']['idname'];
	} 

	public function targetClass(): string
	{
		return Rooms::class;
	}

	private function getNormArray(DTO $dto) : array
	{
		$raw = $dto->getDataArray();
		$mapper = $this->fact->getMapper($raw);
		return $mapper->return_dto_to_domain_array();
	}

	protected function build(DTO $dto) : void
	{
		$room_norm_array = $this->getNormArray($dto);   							//runs through the mapper listed above
	
		if (!empty($room_norm_array['outlets'])) {									//strip the outlets DNs if they exist.
			$outlets=$room_norm_array['outlets'];
			unset($room_norm_array['outlets']);
		}

		if (!empty($room_norm_array['computers'])) {
			$computers=$room_norm_array['computers'];
			unset($room_norm_array['computers']);
			echo "RoomsRepository.php computers <pre>";
			print_r($computers);
		}

		$room = $this->dofact->createObject($room_norm_array);

		if (!empty($outlets)) {				//add the outlets to room.
			$this->assignMultipleOutletsToRoom($outlets, $room);
		}	
		//Assign computers if the exist
		if (!empty($computers)) {
			foreach($computers as $computer) {
				$room->assignComputerToRoom($computer['computerdn']);
			}
		}
		echo "RoomsRepository.php Rooms Entity Object <pre>";
		print_r($room);

		$deleteall = ($this->function == 'addDelete') ? 'deleteall' : null;
		if ($room->getOutlets()) {													
			$this->handleCurrentRoomOutlets($room, $deleteall);						//this assigns outlets to the the correct addDirtyDeleteNew	
		}
		
		$this->objwatcher::{$this->function}($room);      //run AddNewDirtyDelete for Rooms
	}

	private function addObjToNewDirtyDelete(string $cur_action, Outlet $obj) : void
	{
		switch ($cur_action) {
			case "create":			
				$this->objwatcher::addNew($obj);
				break;
			case "update":				
				$this->objwatcher::AddDirty($obj);
				break;
			case "delete":
				$this->objwatcher::addDelete($obj);
				break;
		}	
	}

	private function assignMultipleOutletsToRoom (array $outlets, Rooms $room) : void
	{
		foreach($outlets as $outlet) {
			$action = $this->dofact->getAction($outlet);	
			$outletnormarray = $this->dofact->returnNormOutletArray($outlet, $action);
			$this->action_array[$outletnormarray['outletid']] = $action;
			$room->assignOutletToRoom($outletnormarray);
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
