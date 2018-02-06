<?php
namespace cmu\html\form\visitors;

class CheckChangeVisitor extends AbstractVisitor

{

    private $ldapvalues = array();
    private $atts;

    function __construct() 

    {

        $ldap = \cmu\html\base\registry\LdapValuesRegistry::getLdapValues();

        $this->ldapvalues = $ldap->returnSingleLdapNormValuesArray();	
            
        $this->atts = array_keys($this->ldapvalues);

    }
    //watch for LOWERCASE key returns on LDAP sets LDAP return key lowercase!!!!
    private function compareChange($value, $name)                                               	//convienince function

    {

        if (in_array(strtolower($name), $this->atts)) {                                             //match

            if (!in_array($value, $this->ldapvalues[strtolower($name)], true)) {
	

                return true;

            }

        }

        if ($this->ldapvalues == null && $value != null) {                              //no values pulled from DB

            return true;

        }
        
    }

    function visitInput(\cmu\html\form\products\Input $component)                           //compare NAME

    {   

        return $this->compareChange($component->getValue(), $component->getName());

    }

    function visitTextArea(\cmu\html\form\products\TextArea $component)

    {

        return $this->compareChange($component->getText(), $component->getName());

    }

    function visitSelect(\cmu\html\form\products\Select $component)

    {

        return $this->compareChange($component->getSelectedvalue(), $component->getName());

    }

}
