<?php

namespace cmu\html\form;

use \cmu\html\products\AbstractMetaQueryDic;
use \cmu\html\base\Meta;
use \cmu\html\form\FormClient;
use \cmu\ddd\directory\infrastructure\services\dto\DTOAssembler;
use \cmu\ddd\directory\infrastructure\services\dto\DTO;
use \cmu\ddd\directory\application\services\RunService;
use \cmu\html\base\registry\RequestRegistry;
use \cmu\html\base\registry\DoValuesRegistry;

class SingMetaQueryDic extends AbstractMetaQueryDic  //Dependancy Injection Container

{

    //constructor from parent: SingMetaQueryDic($meta, $ldap_parms);
	
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
