<?php

namespace cmu\html\form;

use \cmu\html\products\AbstractMetaQueryDic;
use \cmu\html\base\Meta;
use \cmu\html\form\FormClient;
use \cmu\ddd\directory\infrastructure\services\dto\DTOAssembler;
use \cmu\ddd\directory\infrastructure\services\dto\DTO;
use \cmu\ddd\directory\application\services\RunService;
use \cmu\html\base\registry\DoValuesRegistry;
use \cmu\config\site\bin\TraitConfig; 
use \cmu\html\base\Request;

class SingMetaQueryDic extends AbstractMetaQueryDic  //Dependancy Injection Container

{
	use TraitConfig;

    function __construct() 
	{

        $this->requestobject = new Request;		//create a new Request, reading from the native form REQUEST

		$this->dn = $this->requestobject->getValue('dn') ?? null;

		if ($this->dn) {
			$entity = ldap_explode_dn($this->dn, 1)[1];
		} else {
			$ou = $this->requestobject->getValue('ou');
			$entity =  ldap_explode_dn($ou, 1)[0];
		}

		$this->metaobject = new Meta($this->getDomainArray($entity));
	}
	//get the file. include it. return array.
	private function getDomainArray($entity) : array
	{

		$filename = $entity . ".conf";    			//we now need to get the config array based on entity
		include	$this->returnIniFile($filename);    //include the file in this method		

		return ${$entity . "_array"};				//return people_array, rooms_array, etc. 
	}

	private function returnDomainDto(array $dnarray) : DTO
	{

		$dto = DTOAssembler::returnDTO($dnarray);

		$action = "get";
		
		return RunService::init($dto, $action );			//retrive from service layer
	}

    protected function returnTotalObject() : Meta
    
    {
       
		$values_request = $this->requestobject->returnNormalizeProperties();

		$values_do = array();

	  	if (isset($this->dn)) {						// better way to check?	
		
			$dto_array = ['dn' => $this->dn];				//send to service layer

			$rdto = $this->returnDomainDto($dto_array);
		
			$do_registry = DoValuesRegistry::getDoValues();		//set values in registry

			$do_registry->setValues($rdto->getDataArray());

			$values_do = $do_registry->getValues();

        } 																						    

		$values = array_merge($values_do, $values_request);	//merge, 2nd array overwrites identical keys of first array

        $this->metaobject->setValues($values);					//set above values internally in object

        $this->metaobject->setSingleTotalArray('values');	//populate the meta totalarray property with correct value key

        return $this->metaobject;			//return TOTAL object with total array stored in totalarray property

    }

    function returnDisplayObject() : FormClient

    {

        return new FormClient($this->returnTotalObject(), $this->requestobject);
    
    }

}
