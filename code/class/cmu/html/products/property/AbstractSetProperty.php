<?php
namespace cmu\html\products\property;

abstract class AbstractSetProperty

{

    protected $value;
    protected $obj;

    function __construct($value_in,  \cmu\html\products\AbstractProduct $obj_in) 

    {

        $this->value = $value_in;

        $this->obj = $obj_in;

    }
    //hook each concrete implimentation will impliment
    abstract function returnValue();

    public function getValueInput()

    {

        return trim($this->returnValue()); //hook

    }

}