<?php
namespace cmu\html\table;

use \cmu\html\base\Meta;
use \cmu\html\base\Request; 
use \cmu\html\table\TableClient;

class TableMetaQueryDic extends \cmu\html\products\AbstractMetaQueryDic             //Dependancy Injection Container
{

    protected $filter = "(objectClass=*)"; 
	
	function __construct(Meta $metaobject_in, array $config_array_in) 
	{
		$config_array =  $config_array_in  ;
		
		foreach ($config_array as $prop => $v) {
		  if (property_exists($this, $prop)) {
			 $this->$prop = $v;
		  }
		}
		$this->metaobject = $metaobject_in;
	}

 	protected function returnTotalObject() : Meta

    {

        $ds = \cmu\wrappers\LdapWrapper::getLdapDs();

        $ldap = new \cmu\wrappers\LdapWrapper($ds);        //query LDAP
        
        $values = $ldap->getEntries($ldap->search($this->dn, $this->filter, $this->att));

        $values_ldap = new \cmu\html\base\LdapValues();

        $values_ldap->setValues($values);

        $this->metaobject->setValues( $values_ldap->returnMultiLdapNormValuesArray() );
    
        $this->metaobject->setMultiTotalArray('tddata');
  
		$ldap->close();

        return $this->metaobject;

    }

    function returnDisplayObject() : TableClient

    {                         
    
        return new TableClient($this->returnTotalObject(), $this->requestobject);  //calls method above
    
    }

}
