<?php
namespace cmu\html\table;

class TableMetaQueryDic extends \cmu\html\products\AbstractMetaQueryDic             //Dependancy Injection Container

{

    protected function returnTotalObject()

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

    function returnDisplayObject()

    {                         
    
        return new \cmu\html\table\TableClient($this->returnTotalObject(), $this->requestobject);  //calls method above
    
    }

}
