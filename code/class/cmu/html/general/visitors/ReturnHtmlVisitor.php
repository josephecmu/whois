<?php
namespace cmu\html\general\visitors;

class ReturnHtmlVisitor extends AbstractVisitor

{
    //A Class
    function visitA(\cmu\html\general\products\A $component)

    {

        $html = "<a ";
            
        $html .= $component->getAttributes();

        $html .= ">";

        $html .= $component->getLinkname();

        $html .= "</a>";

        return $html; 

    }
    //SPAN Class
    function visitSpan(\cmu\html\general\products\Span $component)

    {

        $html = "<span ";
            
        $html .= $component->getAttributes();

        $html .= ">";

        $html .= $component->getSpanData();

        $html .= "</span>";

        return $html; 

    }
    //DIV Class
    function visitDiv(\cmu\html\general\products\Div $component)

    {

        $html = "<div ";
            
        $html .= $component->getAttributes();

        $html .= ">";

        $html .= $component->getDivData();

        $html .= "</div>";

        return $html; 

    }
    
}