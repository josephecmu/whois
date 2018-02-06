<?php 
namespace cmu\html\form\products;

abstract class AbstractComposite extends AbstractControls implements \cmu\html\products\InterfaceComposite

{

    use \cmu\html\products\TraitCompositeProduct;

    function sanitizeForm()
    
    {
    
    	foreach ($this->components as $formcomponent) {
    
            if (is_subclass_of($formcomponent, 'cmu\html\form\products\AbstractControls')) {  //only check FORM CONTROLS!!

                $formcomponent->sanitizeForm();
        
            }

    	}
    
    }

    function checkChange()
    
    {

    	foreach ($this->components as $formcomponent) {
    
            if (is_subclass_of($formcomponent, 'cmu\html\form\products\AbstractControls')) {  //only check FORM CONTROLS!!

                if ($formcomponent->checkChange()) {

                    return true;

                }
        
            }

    	}  
    
    }

    protected function buildPost()

    {

        foreach ($this->components as $formcomponent) {

            if (is_subclass_of($formcomponent, 'cmu\html\form\products\AbstractControls')) {  //only check FORM CONTROLS!!

                $formcomponent->buildPost();

            }

        }

    }

    public function returnHtml()  //return composite html FORM and CONTROL

    {
        
        $html = $this->returnHint();

        $html .= "<" . $this->getTag() . " ";
        
        $html .= $this->getAttributes();

        $html .= ">";

        foreach ($this->components as $formcomponent) {

            $html .= $formcomponent->returnHtml();
            //close tag/////
            if ($formcomponent === end($this->components)) {
                //validation
                if (!$this->validate()) {

                    $html .= $this->returnErrorMessage();

                }

                $html .= "</" . $this->getTag() . ">";

            return $html;

            }

        }

    }
    //call methods over entire created composit control
    public function appendGlobalAttributeByObject($prop, $obj, $append_value)

    {

        foreach ($this->components as $formcomponent) {

            echo $formcomponent->appendGlobalAttributeByObject($prop, $obj, $append_value);

        }

    }   

}