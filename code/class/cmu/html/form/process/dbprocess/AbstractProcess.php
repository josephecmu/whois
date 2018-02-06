<?php
namespace cmu\html\form\process\dbprocess;

abstract class AbstractProcess

{

    protected $returnpostobj;    //DTO
    protected $dn;
    protected $ds;  //ds handle
    protected $id;  //CN, UID, etc.
    protected $objectclasses = array();


    function __construct(\cmu\html\base\ReturnPost $returnpostobj_in, $dn_in = null)

    {

        $this->returnpostobj = $returnpostobj_in;

        $this->dn = $dn_in;

        $this->ds = \cmu\wrappers\LdapWrapper::getLdapDs();                     //connection handle
        
        $context = new \cmu\html\form\process\dbprocess\setproperties\ContextSetProperties($this->getOu($this->dn)); //STRATEGY setter based on ou

        $this->id = $context->returnProperty('id');

        $this->objectclasses = $context->returnProperty('objectclasses');       //get objectClasses

    }
    
    abstract function modify();
    //below should be part of idgenerator
    protected function getOu(string $dn = null)                                        //recursive method to get to 'ou' from any prepending string on dn, remove prepending...
    
    {

        if ($this->returnpostobj->getValue('ou')) {                             //ou may alreay be passed ADD, if so, just return it.

            return $this->returnpostobj->getValue('ou');

        }
    	
    	$firstcomma = substr($dn, 0, strpos( $dn, ',', 0) );                    //we need to cut up string UPDATE /DELETE
			
		if (strpos($firstcomma, "ou=") === 0) {                                 //make sure first char string 'ou='

			return $firstcomma;                                                 //break and return value, BASE CASE
				
		} 
		
		$result = $this->getOu( str_replace($firstcomma . ',',  '', $dn ) );	//strip off $firstcomma (with comma), it does not start with 'ou=' //test again
	
		if ($result != false) {

			return $result;

		} 

		return false;                                                           //DEFAULT for recursive function
    
    }
    
    protected function getLdapAttributes()                                      //get attributes using object class array

    {

        $ldapwrapper = new \cmu\wrappers\LdapWrapper($this->ds);

        foreach ($this->objectclasses as $objclass) {

            $retattrs = $ldapwrapper->getAttributes($objclass);

            $attrs = (isset($array)) ? array_merge($retattrs, $attrs) : $retattrs ;     //either initalize $attrs, or merge

        }

        return $attrs;

    }

    protected function removeNonAttKeys(array $postarray, array $schemaarray) : array

    {

        foreach ($postarray as $k => $v) {

            if (in_array($k, $schemaarray)) {                                           //we have keys that are LDAP attributes, add it.

                $newpostarray[$k] = $v;

            }

        }

        return $newpostarray;

    }

}