<?php
/*
 * this class is my implimentation of mapper
 * it converts arrays to required structures for:
 * - LDAP insertion
 * (or the other way...)
 * - Domain Object creation (new People($array))
 */
namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper;
 
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\Mod;

abstract class AbstractMapper

{

	protected  $raw = [];
	function __construct(array $raw)
	{

		$this->raw = $raw;

	}
	//GETTERS
	public function getNameMap() : array
	{

		return $this->name_map;

	}

	public function getSingleMap() : array
	{

		return $this->single_map;

	}

	public function getGroupMap() : array
	{

		return $this->group_map;

	}

	public function getToArray() : array

	{

		return $this->to_array_map;

	}

	public function getRaw() : array
	{

		return $this->raw;

	}
	public function getEntityMap() : array
	{
		return $this->entity_map;

	}
	//END GETTERS
	///here we prepare the $raw db array for domain hydration
	public function return_ldap_collection_array_to_domain() : array 
	{

		//total ldap records
		$count = $this->raw['count'];
	
		$records = [];

		//We have to pass $this...as $this is the Entity Mapper with the arrays to map.
		//Mod can handle only SINGLE records, but we have to pass as second param.  So we iterate...
		for ($i=0; $i<$count; $i++) {
		
			$raw = $this->raw[$i]; 		

			 //Fluent Interface
			 $records[] = (new Mod($this, $raw))  //we pass the concrete child mapper
				->remap_keys()
				->to_array()
				->single_elements()
				->remove_int_keys()
				->group_elements()
				->remove_count_recursive()
				->returnFinalArray()
				;

		}

		return $records;
	}

	//ignore for now
	public function return_object_to_ldaparray() : array

	{
		//Fluent Interface 
		$record = (new Mod($this, $this->raw))  //we pass the concrete child mapper
		->move_elements_up_if_not_in_entity_map()
		->expose_protected()
		->expose_private()
		->reverse_remap_keys()
		->returnFinalArray() 
		;
		
		return $record;

	}

}
