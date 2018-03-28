<?php
namespace cmu\html\form\visitors;

class CheckChangeVisitor extends AbstractVisitor

{

    private $dovalues = array();
    private $atts;

    function __construct() 

    {

		$do_reg = \cmu\html\base\registry\DoValuesRegistry::getDoValues();

		$this->dovalues = $do_reg->GetValues();	

        $this->atts = array_keys($this->dovalues);

    }
    //watch for LOWERCASE key returns on LDAP sets LDAP return key lowercase!!!!
    private function compareChange($value, $name)                                  	//convienince function

    {

        if (in_array(strtolower($name), $this->atts)) {                                             //match

			//if (!in_array($value, $this->ldapvalues[strtolower($name)], true)) {              //removed type checking
            if (!in_array($value, $this->dovalues[strtolower($name)])) {

                return true;

            }

        }

        if ($this->dovalues == null && $value != null) {                              //no values pulled from DB

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
