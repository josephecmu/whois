<?php
namespace cmu\html\table\products;

trait TraitColspan
//COLSPAN
{

    private $colspan;

    
    function setColspan($colspan_in)

    {

        $this->colspan = $colspan_in;

    }

    protected function getHtmlColspan()

    {

        if (isset($this->colspan)) { 
        
            return  "colspan = '" . $this->colspan . "'";

        }

    }

}