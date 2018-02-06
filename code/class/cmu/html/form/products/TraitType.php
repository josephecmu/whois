<?php
namespace cmu\html\form\products;

trait TraitType

{ 

    private $type; //text, checkbox, etc.
    
    
    function setType($type_in)

    {

        $this->type = $type_in;

    }

     public function getType()

    {

        return $this->type;
    
    }

    protected function getHtmlType()

    {

        if (isset($this->type)) { 
        
            return  "type = '" . $this->type . "'";

        }

    }

}