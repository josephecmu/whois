<?php
namespace cmu\html\form\visitors;

class ReturnHtmlVisitor extends AbstractVisitor

{

    function visitInput(\cmu\html\form\products\Input $component)

    {

        $html =  "<input ";
        
        $html .= $component->getAttributes();

        $html .= ">";

        $html .= "</input>";

        $html .= $component->getCaption();                                              //labels for RADIO and CHECKBOX

        $html .= $component->returnHint();

        $html .= $component->returnErrorMessage();
    
        return $html;

    }

    function visitCloseTag(\cmu\html\form\products\CloseTag $component)
    
    {

        return $component->getTag();

    }
    
    function visitDatalist(\cmu\html\form\products\Datalist $component)
    
    {
    
        $html =  "<datalist ";

        $html .= $component->getAttributes();

        $html .= ">";

        $html .= $component->buildTraitOptions();

        $html .= "</datalist>";
    
        return $html;

    }

    function visitFieldset(\cmu\html\form\products\Fieldset $component)
    
    {
    
        $html =  "<fieldset ";
        
        $html .= $component->getAttributes();

        $html .= ">";
    
        return $html;


    }

    function visitLabel(\cmu\html\form\products\Label $component)
    
    {

        $html =  "<label ";

        $html .= $component->getAttributes();

        $html .= ">";

        $html .= $component->getLabel();

        $html .= "</label>";
    
        return $html;

    }

    function visitLegend(\cmu\html\form\products\Legend $component)
    
    {

        $html = "<legend ";
    
        $html .= $component->getAttributes();

        $html .= ">";

        $html .= $component->getHtmlLegendname();

        $html .= "</legend>";

        return $html;

    }

    function visitSelect(\cmu\html\form\products\Select $component)
    
    {

        $html =  "<select ";
        
        $html .= $component->getAttributes();

        $html .= ">";

        $html .= $component->buildTraitOptions();

        $html .= "</select>";

        $html .= $component->returnHint();
    
        return $html;

    }

    function visitTextArea(\cmu\html\form\products\TextArea $component)
    
    {

        $html =  "<textarea ";
                
        $html .= $component->getAttributes();

        $html .= ">";
        
        $html .= $component->getTextareatext();
        
        $html .= "</textarea>";

        $html .= $component->returnHint();

        $html .= $component->returnErrorMessage();
    
        return $html;

    }

    function visitButton(\cmu\html\form\products\Button $component)
    
    {

        $html =  "<button ";
                
        $html .= $component->getAttributes();

        $html .= ">";
        
        $html .= "</button>";
    
        return $html;

    }

}