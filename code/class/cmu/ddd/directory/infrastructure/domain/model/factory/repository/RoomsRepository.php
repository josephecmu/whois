<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\RoomsDn;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\domain\model\actors\people\Rooms;
use cmu\ddd\directory\infrastructure\domain\model\idobject\RoomsIdentityObject;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;

class RoomsRepository extends AbstractRepository 
{

	public function getDn(DTO $dto) : string
	{

		$cn = $dto->get('cn');

		$dn = $this->buildDn($cn);

		return $dn;
	}

	protected function buildDn(string $id) : string
	{
	
		return RoomsDn::buildDn($id);

	}

	protected function getIdObjectSearchById(string $id) : RoomsIdentityObject
	{

		$idobj = new RoomsIdentityObject();

		$idobj->field('cn')->eq($id);

		return $idobj;
	}

	public function remove() 
	{


	}

	private function splitOutlets(array $room) : array
	{

			$outlets = $room->getOutlets();

			unset($room['outlets']);

			return array_push($room, $outlets);					

	}

	private function modify(array $array, string $action) : bool
	{

		$array = array_filter($array);
		if (!empty($array)) {

			foreach ($array as $value) {

				$pair = $this->splitOutlets($room);

				foreach ($pair as $obj) {

					$results[] = $this->getDoa($obj)->$action($obj);
				
				}

			}

		}
	}

	public function performOperations() : bool

	{

		$results[] = $this->modify($this->dirty, 'update');

		$results[] = $this->modify($this->new, 'add');

        return (!in_array(0, $result)) ? true : false;

	}

}
