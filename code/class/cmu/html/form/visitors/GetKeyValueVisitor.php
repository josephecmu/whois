<?php
namespace cmu\html\form\visitors;

class GetKeyValueVisitor extends AbstractVisitor

{

    function visitInput(\cmu\html\form\products\Input $component)

    {
       
        $visitor = new \cmu\html\form\visitors\input\GetKeyValueInputVisitor;       //Call secondary VISITOR to handle input TYPES (text, submit, radio, etc)
    
        return $this->accept($visitor, $component);

    }

    function visitTextArea(\cmu\html\form\products\TextArea $component)

    {

        if (null !== $component->getText() ) {
            
            return $component->getName() . ";" . $component->getText() ;

        }
        
    }

    function visitSelect(\cmu\html\form\products\Select $component)

    {

        foreach($component->getOptionsArray() as $k => $v) {
            
            if ($component->getSelectedvalue() == $v) {                             //check if the VALUE matches the SELECTEDVALUE
                
                return $component->getName()  . ";" . $v ;                          //we could also return $k if required (lookups),  but will mostly be VALUE. Could add switch to return KEY

            }

        }

    }

}