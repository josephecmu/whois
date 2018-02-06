<?php
namespace cmu\html\form\process\dbprocess;

class ProcessContext

{

    private $strategy;

    function __construct(\cmu\html\base\ReturnPost $returnpostobj_in, \cmu\html\base\Request $request_in)

    {

        $button_name = $request_in->getValue('action');                    

        $parts = preg_split('/(?=[A-Z])/', $button_name, -1, PREG_SPLIT_NO_EMPTY); //we should grab the action by retreiveing the last capital word

        $class = "\\cmu\html\\form\\process\\dbprocess\\Process" . end($parts) ;

        $this->strategy = new $class($returnpostobj_in, $request_in->getValue('dn'));  //assign strategy to property

    }

    function modifyLdap() : bool

    {

        return $this->strategy->modify();

    }

}