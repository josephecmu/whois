<?php
namespace cmu\html\table\products;

trait TraitHeaders
//HEADERS
{

    private $headers;

    
    function setHeaders($headers_in)

    {

        $this->headers = $headers_in;

    }

    protected function getHtmlHeaders()

    {

        if (isset($this->headers)) { 
        
            return  "headers = '" . $this->headers . "'";

        }

    }

}