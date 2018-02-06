<?php
namespace cmu\html\products\property;

class SetPropertyContext

{

    public function setValue($value, \cmu\html\products\AbstractProduct $obj)

    {
        //if contains __ and is property of object
        if (property_exists($obj, str_replace('__', '', substr($value, 2))))  {

            $class_name = "SetPropertyUnderscore";
        //contains %%#
        } elseif (strpos($value, '%%#') !== false) {

            $class_name = "SetPropertyExternalarray";


        } else {

            return $value;  //default return the passed value

        }

        $class_name = "\\cmu\\html\\products\\property\\"   .   $class_name;

        $strategy = new $class_name($value, $obj);  //call concrete strategy

        return ($strategy->getValueInput()); //get the value from conrete strategy using parent method getValueInput()   

    }

}