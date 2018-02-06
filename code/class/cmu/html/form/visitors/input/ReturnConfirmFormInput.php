<?php 
namespace cmu\html\form\visitors\input;

class ReturnConfirmFormInput extends AbstractInputVisitor

{
    //I don't think we need this, it was a static page to confirm page before changes "LOCKED"
    function visitText(\cmu\html\form\products\Input $component)

    {

        $html =  "<span ";
        
        $html .= $component->getHtmlClass();

        $html .= ">";

        $html .= $component->getValue();

        $html .= "</span>";
    
        return $html;

    }

    function visitRadio(\cmu\html\form\products\Input $component)

    {

        $html =  "<span ";
        
        $html .= $component->getHtmlClass();

        $html .= ">";

        $html .= $component->getCheckedValue();

        $html .= "</span>";
    
        return $html;
       

    }

    function visitCheckbox(\cmu\html\form\products\Input $component)

    {

        $html =  "<span ";
        
        $html .= $component->getHtmlClass();

        $html .= ">";

        $html .= $component->getCheckedValue();

        $html .= "</span>";
    
        return $html;

    }

}