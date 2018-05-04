<?php
namespace cmu\html\form\process\postprocess;

class PostProcess

{
    private $returnpostobj;
    //private $action;
    //private $dn;


    function __construct( \cmu\html\base\ReturnPost $returnpostobj_in)

    {

        $this->returnpostobj = $returnpostobj_in;

    }

    //What is this used for?
    function doSomething() : bool

    {

        echo "PostProcess";

        return true;

    }

}
