<?php 
namespace cmu\html\form\products;

trait TraitAutofocus

{

    protected $autofocus = null;

    public function setAutofocus($autofocus_in)

    {

        if (isset($autofocus_in)) {

            $this->autofocus = "autofocus";
        
        }

    }

    protected function getHtmlAutofocus()

    {

        if (isset($this->autofocus)) { 
    
            return "autofocus";

        }

    }

}