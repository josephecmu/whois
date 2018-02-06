<?php
namespace cmu\html\table\products;

class Caption extends AbstractTableComponent
//CAPTION
{

    private $captiontext;

    function setCaptiontext( string $captiontext_in)

    {

        $this->captiontext = $captiontext_in;

    }

    function getCaptiontext()

    {
        
        return  $this->captiontext ;

    }

}