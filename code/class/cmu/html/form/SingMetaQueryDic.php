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

	private $entity;

    function __construct() 
	{

        $this->requestobject = new Request;		//create a new Request, reading from the native form REQUEST

		$this->dn = $this->requestobject->getValue('dn') ?? null;

		if ($this->dn) {
			$this->entity = ldap_explode_dn($this->dn, 1)[1];
		} else {
			$ou = $this->requestobject->getValue('ou');
			$this->entity =  ldap_explode_dn($ou, 1)[0];
		}

		$this->metaobject = new Meta($this->getDomainArray($this->entity));
	}
	//get the file. include it. return array.
	private function getDomainArray($entity) : array
	{

		$state = $this->getState();

		$filename = $entity . "_" . $state . ".conf";    			//we now need to get the config array based on entity
		include	$this->returnIniFile($filename);    //include the file in this method		

		return ${$entity . "_" . $state . "_array"};				//return people_array, rooms_array, etc. 
	}

	private function returnDomainDto(array $dnarray, string $entity) : DTO
	{

		$dto = DTOAssembler::returnDTO($dnarray, $entity);

		return RunService::init($dto, 'get' );			//retrive from service layer
	}

    protected function returnTotalObject() : Meta
    
    {
       
		$values_request = $this->requestobject->returnNormalizeProperties();

		$values_do = array();

	  	if ($this->dn) {											// better way to check?	
		
			$dto_array = ['dn' => $this->dn];						//send to service layer

			$rdto = $this->returnDomainDto($dto_array, $this->entity);
		
			$do_registry = DoValuesRegistry::getDoValues();			//set values in registry

			$do_registry->setValues($rdto->getDataArray());

			$values_do = $do_registry->getValues();

        } 																						    

		$values = array_merge($values_do, $values_request);	//merge, 2nd array overwrites identical keys of first array

        $this->metaobject->setValues($values);					//set above values internally in object

        $this->metaobject->setSingleTotalArray('values');	//populate the meta totalarray property with correct value key

        return $this->metaobject;			//return TOTAL object with total array stored in totalarray property



    }

    private function getState()                   //used to set state of form and build buttons

    {
		if (!empty($this->requestobject->getValue('dn'))) {                               //we have data passed
			
			return 'existing';    

		}

        return 'new';                                                   //default 'add'

    }

    function returnDisplayObject() : FormClient

    {

        return new FormClient($this->returnTotalObject(), $this->requestobject);
    
    }

}
