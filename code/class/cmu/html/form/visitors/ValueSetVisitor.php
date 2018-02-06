<?php
namespace cmu\html\form\visitors;

class ValueSetVisitor extends AbstractVisitor

{

    function visitInput(\cmu\html\form\products\Input $component)

    {
         ////Call secondary VISITOR to handle input TYPES (text, submit, radio, etc)
        $visitor = new \cmu\html\form\visitors\input\ValueSetInputVisitor;
    
        return $this->accept($visitor, $component);

    }

    function visitTextArea(\cmu\html\form\products\TextArea $component)
    
    {

        if (null != $component->getText()) {

            return true;
 
        }

    }

    function visitSelect(\cmu\html\form\products\Select $component)

    {

        if (null != $component->getSelectedvalue() ) {

            return true;

        }

    }

    function visitButton(\cmu\html\form\products\Button $component)
    
    {

        return true;

    }

}