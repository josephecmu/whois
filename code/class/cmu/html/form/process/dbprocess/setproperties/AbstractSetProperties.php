<?php
namespace cmu\html\form\process\dbprocess\setproperties;

abstract class AbstractSetProperties

{
    
    protected $id = null;
    protected $objectclasses = array();


    function getProperty(string $property)  //string or array

    {

        return $this->$property;

    }

}
