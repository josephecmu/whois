<?php 
namespace cmu\html\form\products;

trait TraitDisabled

{

    protected $disabled = null;

    public function setDisabled($disabled_in)

    {

        if (isset($disabled_in)) {

            $this->disabled = "disabled";
        
        }

    }

    protected function getHtmlDisabled()

    {

        if (isset($this->disabled)) { 
    
            return $this->disabled;

        }

    }

}