<?php
namespace cmu\html\products\property;

class SetPropertyUnderscore extends AbstractSetProperty

{

    public function returnValue()

    {

        if (property_exists($this->obj, str_replace('__', '', substr($this->value, 2)))) {

            $property = str_replace('__', '', $this->value);

            $getter = 'get'.ucwords($property);  //dynamic getter

            return $this->obj->$getter();  //get the value of the 'external' (local container) property

        }

    }

}