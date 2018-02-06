<?php
namespace cmu\html\form\products;

trait TraitPlaceholder

{

    private $placeholder;

    function setPlaceholder( string $placeholder_in)

    {

        $this->placeholder = $placeholder_in;

    }

    protected function getHtmlPlaceholder()

    {

       if (isset($this->placeholder)) { 
        
            return  "placeholder = '" . $this->placeholder . "'";

        }

    }

}