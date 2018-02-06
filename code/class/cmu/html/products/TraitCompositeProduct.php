<?php 
namespace cmu\html\products;

trait TraitCompositeProduct

{
    //holds the individual components
    protected $components = array();

    abstract function getTag(); //required to set the HTML tag for COMPOSITE item in concrete classes

    public function getComponents()

    {

        return $this->components;

    }

    public function addComponent(\cmu\html\products\AbstractProduct $component_in)

    {

        if (in_array ($component_in, $this->components, true)) {  //if already in array, exits

            return;

        }
        
        $this->components[] = $component_in;

    }
    
    public function removeComponent(\cmu\html\products\AbstractProduct $component_in)

    {
    
    	//remove leafs nodes here
    
    }

    public function returnHtml()  //return composite html FORM and CONTROL, overrrides AbstractProduct::returnHtml() and makes PUBLIC

    {
        
        $html = parent::returnHtml();

        foreach ($this->components as $tablecomponent) {

            $html .= $tablecomponent->returnHtml();

            if ($tablecomponent === end($this->components)) {

                $html .= "</" . $this->getTag() . ">";

            }

        }

        return $html;

    }

}