<?php
namespace cmu\html\table\products;

class Th extends AbstractTableComponent
//TH
{

    use TraitColspan, TraitHeaders;

    private $thdata;

    function setthdata($thdata_in)

    {

        $this->thdata = $thdata_in;

    }

    function getThdata()

    {
        
        return $this->thdata ;

    }


}