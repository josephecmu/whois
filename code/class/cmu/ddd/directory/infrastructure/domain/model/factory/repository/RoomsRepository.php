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
	private function build(DTO $dto, string $type) 
	
	{
		switch ($type) {
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

		$this->$function($room);

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

				}	
			}

		}

	}


	public function buildDn(string $id) : string
	{
	
		return RoomsDn::buildDn($id);

	}
	//overrride from the Parent	to handle sub-objects
//	public function addDirty(AbstractEntity $room)
//	{
//		echo "<br>RoomsRepository.php rooms<br>";
//		print_r($room);
//
//		$objs[]=$room;
//
//		$outlets = $room->getOutlets() ?? null;
//
//		if ($outlets){
//
//			foreach ($outlets as $outlet) {
//
//				$objs[] = $outlet;
//
//			}
//		}
//
//		foreach ($objs as $obj) { 		
//
//			$uniqid = $obj->getuid();
//
//			$okey = $this->globalKey($uniqid);
//
//			if (! array_key_exists($okey, $this->dirty)) {
//
//				echo "<br>RoomsRepository.php obj<br>";
//				print_r($obj);
//
//				$this->dirty[$okey] = $obj;
//
//			}
//		
//		}
//
//	}

//	private function splitOutlets(array $room) : array
//	{
//
//			$outlets = $room->getOutlets();
//
//			unset($room['outlets']);
//
//			return array_push($room, $outlets);					
//
//	}
//
//	private function modify(array $array, string $action) : bool
//	{
//
//		$array = array_filter($array);
//		if (!empty($array)) {
//
//			foreach ($array as $value) {
//
//				$pair = $this->splitOutlets($room);
//
//				foreach ($pair as $obj) {
//
//					$results[] = $this->getDoaFromObject($obj)->$action($obj);
//				
//				}
//
//			}
//
//		}
//	}

//	public function performOperations() : bool
//
//	{
//
//		$results[] = $this->modify($this->dirty, 'update');
//
//		$results[] = $this->modify($this->new, 'add');
//
//        return (!in_array(0, $result)) ? true : false;
//
//	}

}
