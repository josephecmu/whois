<?php
namespace cmu\html\form\visitors;

class SanitizeVisitor extends AbstractVisitor

{
    //specific implimentations//////////////////////////////////////////////////////
    function visitInput(\cmu\html\form\products\Input $component)

    {
        //if we have a value , type is TEXT and sanitize is set
        //we can only validate TEXT input
        if (($component->getType() == "text") && null !== $component->getSanitize() &&  null != $component->getValue()) {
            
            $sanitize = new \cmu\html\form\sanitize\SanitizeContext($component->getSanitize());
            
            $component->setValue($sanitize->sanitizeText($component->getValue()));
            
        }

    }
    
    function visitTextArea(\cmu\html\form\products\TextArea $component)
    
    {

        if (null !== $component->getSanitize() && null != $component->getText()){
    
            $sanitize = new \cmu\html\form\sanitize\SanitizeContext($component->getSanitize());
            
            $component->setText($sanitize->sanitizeText($component->getText())) ;
            
        }

    }

}