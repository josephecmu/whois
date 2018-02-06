<?php
namespace cmu\html\form\products;

class Label extends AbstractFormComponent

{

    private $for = null;
    private $label = null;
    
    
    function setFor($for_in)

    {

        $this->for = $for_in;

    }

    function setLabel( string $label_in)

    {

        $this->label = $label_in;

    }

    protected function getHtmlFor()

    {

        if (isset($this->for)) { 
        
            return  "for = '" . $this->for . "'";

        }

    }

    public function getLabel()

    {

        if (isset($this->label)) { 
        
            return  $this->label;

        }

    }

}