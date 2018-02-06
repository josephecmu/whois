<?php
namespace cmu\html\table\products;

trait TraitSpan
//COLSPAN
{

    private $span;
    
    function setSpan( int $span_in)

    {

        $this->span = $span_in;

    }

    protected function getHtmlSpan()

    {

        if (isset($this->span)) { 
        
            return  "span = '" . $this->span . "'";

        }

    }

}