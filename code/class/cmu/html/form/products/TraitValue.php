<?php 
namespace cmu\html\form\products;

trait TraitValue  //used to validate at the LEAF level for text errors regex

{

    private $value;
    
    function setValue($value_in)

    {

        $this->value = $value_in;

    }
    
    public function getValue()

    {

        return $this->value;
    
    }
    
    protected function getHtmlValue()

    {

        if (isset($this->value)) { 
        
            return  "value = '" . $this->value . "'";

        }

    }

}