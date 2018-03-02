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
use cmu\config\site\bin\Registry;
use cmu\config\site\bin\Conf;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\config\AbstractConfig; 

abstract class AbstractMapper
{
	protected $name_map = []; 
	protected $single_map = [];
	protected $group_map = [];
	protected $to_array_map = [];
	protected $entity_map = [];
	protected $conf;      							//returns object that stores ini data of above maps
	protected $raw = [];
	protected $ini = CONFDIR . "mapper.ini";     	// ini file to read	

	function __construct(array $raw)
	{
	 	$options = parse_ini_file($this->ini, true);
		$this->conf = $this->getConfig($options); 
		
		$this->setNameMap();
		$this->setSingleMap();
		$this->setGroupMap();
		$this->setToArrayMap();
		$this->setEntityMap();

		$this->raw = $raw;
	}

	abstract protected function getConfig($options) : AbstractConfig ;

	//a helper function may help below...much duplication

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
	//SETTERS  setters read from the Conf() object.
	protected function setNameMap()
	{

		$this->name_map = $this->conf->get("name_map"); 
	}

	protected function setSingleMap()
	{
		$this->single_map = $this->conf->get("single_map");
	}

	protected function setGroupMap()
	{

		$this->group_map = $this->conf->get("group_map");

	}

	protected function setToArrayMap()
	{

		$this->to_array_map = $this->conf->get("to_array_map");

	}

	protected function setEntityMap()
	{

		$this->entity_map = $this->conf->get('entity_map');	

	}
	//END SETTERS
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

	public function return_object_to_ldaparray() : array

	{
		//Fluent Interface 
		$record = (new Mod($this, $this->raw))  //we pass the concrete child mapper
		->recurse_expose_private_and_protected()
		->move_elements_up_if_not_in_entity_map()
		->reverse_remap_keys()
		->returnFinalArray() 
		;
		
		return $record;

	}

}
