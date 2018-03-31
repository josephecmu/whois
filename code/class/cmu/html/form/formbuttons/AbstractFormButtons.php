<?php

namespace cmu\html\form\formbuttons;

use \cmu\html\form\builders\VariableSingleBuilder;
use \cmu\html\products\AbstractHtmlDisplayClient;

abstract class AbstractFormButtons

{

    protected $formclient;
    
    function __construct(AbstractHtmlDisplayClient $formclient_in)

    {

        $this->formclient = $formclient_in;

    }
    
    abstract function addToForm();              //hook each concrete implimentation will impliment
    
    protected function createButton($value)     //Factory Method

    {

        $button = new VariableSingleBuilder("Input", ['name' => 'action', 'value'=>$value, 'type'=>'submit']);

        $button->build($this->formclient->getDisplay());

    }
    
}
