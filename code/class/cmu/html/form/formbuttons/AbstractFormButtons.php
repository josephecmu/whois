<?php
namespace cmu\html\form\formbuttons;

abstract class AbstractFormButtons

{

    protected $formclient;
    
    function __construct(\cmu\html\products\AbstractHtmlDisplayClient $formclient_in)

    {

        $this->formclient = $formclient_in;

    }
    
    abstract function addToForm();              //hook each concrete implimentation will impliment
    
    protected function createButton($value)     //Factory Method

    {

        $button = new \cmu\html\form\builders\VariableSingleBuilder("Input", array ('name' => 'action', 'value'=>$value, 'type'=>'submit'));

        $button->build($this->formclient->getDisplay());

    }
    
}