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
use cmu\ddd\directory\infrastructure\domain\model\share\TraitConfigDomain;
use cmu\config\site\bin\Conf;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors\ObjectToLdapConverter;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors\DtoToDomainConverter;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors\LdapToDomainConverter;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors\ObjectToDTOConverter;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors\ObjectToLdapConverterAdd;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors\ObjectToLdapConverterUpdate;

abstract class AbstractMapper
{

	use TraitConfigDomain;

	protected $name_map = []; 
	protected $single_map = [];
	protected $group_map = [];
	protected $to_array_map = [];
	protected $entity_map = [];
	protected $object_class_map = [];
	protected $delete_key_map = [];
	protected $raw = [];
	protected $sub_object_map=[];
	protected $remove_key_map=[];

	function __construct(array $raw)
	{
			$options = $this->getConfigArray("mapper.ini");
			$conf = $this->returnConcreteConfigObject($options);    //returns child Conf object
			//set
			$this->name_map = $conf->get("name_map"); 
			$this->single_map = $conf->get("single_map");
			$this->entity_map = $conf->get('entity_map');	
			$this->to_array_map = $conf->get("to_array_map");
			$this->group_map = $conf->get("group_map");
			$this->object_class_map = $conf->get("object_class_map");
			$this->delete_key_map = $conf->get("delete_key_map");
			$this->sub_object_map = $conf->get("sub_object_map");
			$this->remove_key_map = $conf->get("remove_key_map");

			$this->raw = $raw;
	}

	//GETTERS
	public function getNameMap() : array
	{
		return $this->name_map ?? [];
	}

	public function getSingleMap() : array
	{
		return $this->single_map ?? [];
	}

	public function getGroupMap() : array
	{
		return $this->group_map ?? [];
	}

	public function getToArray() : array
	{
		return $this->to_array_map ?? [];
	}

	public function getRaw() : array
	{
		return $this->raw;
	}

	public function getEntityMap() : array
	{
		return $this->entity_map ?? [];
	}

	public function getObjectClassMap() : array
	{
		return $this->object_class_map;
	}

	public function getDeleteKeyMap() : array
	{
		return $this->delete_key_map ?? [];
	}

	public function getSubObjectMap() : array
	{
		return $this->sub_object_map ?? [];
	}

	public function getRemoveKeyMap() : array
	{
		return $this->remove_key_map ?? [];
	}
	//END GETTERS

	public function return_ldap_collection_array_to_domain() : array 
	{
		//total ldap records
		$count = $this->raw['count'];
	
		$records = [];

		//We have to pass $this...as $this is the Entity Mapper with the arrays to map.
		//Mod can handle only SINGLE records, but we have to pass as second param.  So we iterate...
		for ($i=0; $i<$count; $i++) {
			$raw = $this->raw[$i]; 		
			$records[] = (new LdapToDomainConverter($this, $raw))->returnConvertedArray();
		}
		return $records;
	}

	public function return_ldap_array_to_domain() : array	//ldap deals with collections by default (above), return one.
	{
		return $this->return_ldap_collection_array_to_domain()[0];
	}

	public function return_object_to_ldaparray() : array
	{
		return (new ObjectToLdapConverter($this))->returnConvertedArray();
	}

	public function return_dto_to_domain_array() : array
	{
		return (new DtoToDomainConverter($this))->returnConvertedArray();
	}

	public function return_object_to_dto_array() : array
	{
		return (new ObjectToDTOConverter($this))->returnConvertedArray();
	}

	public function return_object_to_ldaparray_update() : array
	{
		return (new ObjectToLdapConverterUpdate($this))->returnConvertedArray();
	}

	public function return_object_to_ldaparray_add() : array
	{
		return (new ObjectToLdapConverterAdd($this))->returnConvertedArray();
	}
}
