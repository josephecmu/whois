<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper;

use cmu\config\site\bin\Conf;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors\LdapToDomainConverter;

class RoomsMapper extends AbstractMapper
{

	protected function returnConcreteConfigObject(array $options) : Conf
	{	
		return $this->returnConfigObject($options['rooms']) ;

	}	
	//reading.  pull direct from database.
	//we need a special mapper for rooms to handle the aggregate (rooms/outlets), override the parent
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
			$sub_object_map=$this->getSubObjectMap();

			foreach ($records[$i] as $k => $v){

				if (isset($sub_object_map[$k])) {

					$newkey=$sub_object_map[$k];  //lookup new value based on key
						
					$ele = count($v);
					for($z=0;$z<$ele;$z++) {
						$records[$i][$newkey][]['dn']=$v[$z];  //we must return an array of subobjects (consistent).
						unset($records[$i][$k]);
					}
		

				}	

			}
		}

		return $records;
	}
}

