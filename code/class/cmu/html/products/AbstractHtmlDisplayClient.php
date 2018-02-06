<?php
namespace cmu\html\products;

abstract class AbstractHtmlDisplayClient

{

    protected $totalobj; //the entire meta and values object
    protected $display; //'old singleton' to hold components
    protected $request; //request object from registry

    function __construct(\cmu\html\base\Meta $totalobj_in)
    
    {

        $this->totalobj = $totalobj_in;

        $this->request = \cmu\html\base\registry\RequestRegistry::getRequest();         //assign object from REGISTRY
    
    }

    public function returnDisplay()

    {

        return $this->display->returnHtml();

    }

    function getDisplay()

    {

        return $this->display;

    }

    function getRequestObject()

    {

        return $this->request;

    }

    function getTotalObj()

    {

        return $this->totalobj;

    }

}