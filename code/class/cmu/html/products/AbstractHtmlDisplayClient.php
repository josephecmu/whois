<?php

namespace cmu\html\products;

use \cmu\html\base\Request;
use cmu\html\base\Meta;

abstract class AbstractHtmlDisplayClient

{

    protected $totalobj; //the entire meta and values object
    protected $display; //'old singleton' to hold components
    protected $request; //request object from registry

    function __construct(Meta $totalobj_in, Request $request_in = null)
    
    {

        $this->totalobj = $totalobj_in;

//        $this->request = \cmu\html\base\registry\RequestRegistry::getRequest();         //assign object from REGISTRY

		$this->request = $request_in ?? null ;	
	//	$this->request=$request_in;

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
