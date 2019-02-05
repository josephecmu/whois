<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\dto;

use \cmu\ddd\directory\domain\model\locations\Rooms;
use cmu\ddd\directory\infrastructure\services\dto\DTOAssembler;
use cmu\ddd\directory\infrastructure\services\dto\DTO;
use cmu\ddd\directory\domain\model\lib\AbstractEntity;

class RoomsDTOFactory extends AbstractDTOFactory
{
	protected function targetClass() : string
	{
		return Rooms::class;
	}

	protected function returnEntity() : string
	{
		return 'rooms';
	}
	//override parent to allow for breakout of subObjects
	public function getDTO(AbstractEntity $obj) : DTO
	{
		$this->verifyTargetClass($obj);
		$raw = $this->object_to_array($obj); // convert Object to array for Mapper
		$mapper = $this->factory->getMapper($raw);
		$data_array = $mapper->return_object_to_dto_array();  
		$sub_object_map = $mapper->getSubObjectMap(); //sub_object_map['outletdn'] = 'outlets'
		//we need to remove the subobject from the root entity
		foreach ($sub_object_map as $sub_name) {
			if (isset($data_array[$sub_name])) {   //check config files
				//create a new variable with the name of the value from sub_object_map (ex. 'outlets')	
				${$sub_name} = $data_array[$sub_name];
				unset($data_array[$sub_name]);
				
				$sub_mapper_name="cmu\\ddd\\directory\\infrastructure\\domain\\model\\factory\\mapper\\" .$sub_name. "Mapper";
				foreach(${$sub_name} as $sub_array_value) {

					//add it back to the Root Object $data_array
					$data_array[$sub_name][] = $this->returnSubArray($sub_mapper_name, $sub_array_value); 
				}
			}
		}
		return DTOAssembler::returnDTO($data_array, $this->returnEntity());
	}

	private function returnSubArray(string $sub_mapper_name, array $sub_array_value) : array
	{
		$sub_mapper=new $sub_mapper_name($sub_array_value);
		return $sub_mapper->return_object_to_dto_array();
	}
}
