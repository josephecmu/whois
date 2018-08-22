<?php 
namespace cmu\html\form\products;

trait TraitActions

{

    protected $onclick = null;

    public function setonclick($onclick_in)

    {

        if (isset($onclick_in)) {

            $this->onclick = $onclick_in;
        
        }

    }

    protected function getHtmlonclick()

    {

        if (isset($this->onclick)) { 
    
            return "onClick=".$this->onclick;

        }

    }

}
