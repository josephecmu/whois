<?php 
namespace cmu\html\form\products;

trait TraitActions

{

    protected $onclick = null;
	protected $click = null;

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

    public function setclick($click_in)

    {

        if (isset($click_in)) {

            $this->click = $click_in;
        
        }

    }

    protected function getHtmlclick()

    {

        if (isset($this->click)) { 
    
            return "click=".$this->click;

        }

    }
}
