<?php
namespace cmu\html\form\process\dbprocess;

class ProcessAdd extends AbstractProcess

{

    private $removeattributes = ['ou'];                                                     //manually remove unwanted attributes to add, this can't be removed by the filter because OU IS and attribute

    function modify() : bool

    {

    	$schemaarray = $this->getLdapAttributes($this->objectclasses);                      //returns all the attributes avaialble in the schemas selected

        $remove_schema_key_array = array_diff($schemaarray, $this->removeattributes);       //MANUALLY remove attributes to be inserted

        $finalpostarray = $this->removeNonAttKeys($this->returnpostobj->getValues(), $remove_schema_key_array);    //remove non-att keys from $postarray based on $schemaarray

        $finalpostarray['objectClass'] = $this->objectclasses;                              //inject [objectClasses] key for submission

        $ldap = new \cmu\wrappers\LdapWrapper($this->ds);                                   //instantiate new LdapWrapper()

        $id = $this->returnpostobj->getValue($this->id);    //dynamic, 'uid' or 'cn'        //get UID array from $this->returnpostobj

        $rdn = $this->id . "=" . $id . "," .$this->getOu() . "," . $ldap->getDn();          //dynamic //build the RDN

        return $ldap->add($rdn, $finalpostarray);                                           //return T or F

    }

}