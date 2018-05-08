<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\repository;

use cmu\ddd\directory\infrastructure\domain\model\identitygenerator\RoomsDn;
use cmu\ddd\directory\domain\model\actors\people\Rooms;
use cmu\ddd\directory\infrastructure\domain\model\idobject\RoomsIdentityObject;
use cmu\ddd\directory\infrastructure\domain\model\DomainObjectAssembler;
use cmu\ddd\directory\infrastructure\domain\model\factory\RoomsPersistenceFactory;

class RoomsRepository extends AbstractRepository 
{


	public function getDn(DTO $dto) : string
	{

		$cn = $dto->get('cn');

		$dn = $this->buildDn($cn);

		return $dn;
	}

	public function buildDn(string $id) : string
	{
	
		return RoomsDn::buildDn($id);

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
