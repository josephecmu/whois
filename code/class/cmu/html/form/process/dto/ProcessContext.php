<?php
namespace cmu\html\form\process\dto;

use \cmu\html\base\ReturnPost;
use \cmu\html\base\Request;

class ProcessContext

{

    private $strategy;

    function __construct(ReturnPost $returnpostobj_in, Request $request_in)

    {

        $button_name = $request_in->getValue('action');                    

        $parts = preg_split('/(?=[A-Z])/', $button_name, -1, PREG_SPLIT_NO_EMPTY); //we should grab the action by retrieving the last capital word

        $class = "\\cmu\html\\form\\process\\dto\\Process" . end($parts) ;				//action

        $this->strategy = new $class($returnpostobj_in, $request_in->getValue('dn'));  //assign strategy to property

    }


    function modifyLdap() : bool

    {

        return $this->strategy->modify();				//calls Add, Delete, Update Strategies

    }

}
