<?php
namespace cmu\html\form;

use \cmu\html\products\AbstractMetaQueryDic;
use \cmu\html\base\Meta;
use \cmu\html\form\FormClient;

use cmu\ddd\directory\application\services\Getpeopleservice;
use cmu\ddd\directory\infrastructure\services\dto\DTOAssembler;
use cmu\ddd\directory\application\services\RunService;

class SingMetaQueryDic extends AbstractMetaQueryDic  //Dependancy Injection Container

{

    //constructor from parent: SingMetaQueryDic($meta, $ldap_parms);
    protected function returnTotalObject() : Meta
    
    {
       
        $values_request =  array();

       	if (null !== $this->requestobject) {

            $request_registry = \cmu\html\base\registry\RequestRegistry::getRequest();

            $values_request = $request_registry->returnNormalizeProperties();

       	}
       	
        $values_do = array();

        if (null !== $this->requestobject->getValue('dn')) {      //GET  //set $values_ldap

		$do_registry = \cmu\html\base\registry\DoValuesRegistry::getDoValues();		
//            $ldap_registry = \cmu\html\base\registry\LdapValuesRegistry::getLdapValues();  //instantiate LdapValues, but stores object in Registry
//
//            $ds = \cmu\wrappers\LdapWrapper::getLdapDs();
//
//            $ldap = new \cmu\wrappers\LdapWrapper($ds);                                    //query LDAP
//
//         $values_ldap = $ldap->getEntries($ldap->search($this->requestobject->getValue('dn'), $this->filter, $this->att));
//
//            $ldap_registry->setValues($values_ldap);			//assign the values to the ldap REGISTRY object
//
//            $values_ldap = $ldap_registry->returnSingleLdapNormValuesArray();       //return NORMALIZED values array (remove count, hand DN)
//
//			$ldap->close();

			/////////////////////////////3-22-18    send to Service Layer /////////////////

		$dto_array= ['dn' => $this->requestobject->getValue('dn')];

		$dto = DTOAssembler::returnDTO($dto_array);

		$action = "get";
		//retrive from service layer
		$rdto =  RunService::init($dto, $action );

		$do_registry->setValues($rdto->getDataArray());

		$values_do = $do_registry->getValues();

///////////////////////////////////////////// END NEW TO SERVICE LAYER

        } 																						    
		//WE MUST CHANGE REQUEST TO LOWER CASE KEYS!!!																					
##		$values = array_merge($values_ldap, array_change_key_case($values_request));  		//merge, 2nd array overwrites identical keys of first array
		$values = array_merge($values_do, $values_request);								//merge, 2nd array overwrites identical keys of first array

        $this->metaobject->setValues($values);							//set above values internally in object

        $this->metaobject->setSingleTotalArray('values');	//populate the meta totalarray property with correct value key
        return $this->metaobject;			//return TOTAL object with total array stored in totalarray property

		

    }

    function returnDisplayObject() : FormClient

    {

        return new FormClient($this->returnTotalObject(), $this->requestobject);
    
    }

}
