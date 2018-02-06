<?php
namespace cmu\html\table\products;

trait TraitRowspan
//COLSPAN
{

    private $rowspan;

    function setRowspan( int $rowspan_in)

    {

        $this->rowspan = $rowspan_in;

    }

    protected function getHtmlRowspan()

    {

        if (isset($this->rowspan)) { 
        
            return  "rowspan = '" . $this->rowspan . "'";

        }

    }

}