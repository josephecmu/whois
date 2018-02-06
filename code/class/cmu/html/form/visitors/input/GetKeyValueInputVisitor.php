<?php 
namespace cmu\html\form\visitors\input;

class GetKeyValueInputVisitor extends AbstractInputVisitor

{
    //useful function to use below.  Check if X is set, then return $key => $value
    private function returnKeyValue($val_to_check, $key, $value)

    {

        if (null != $val_to_check ) {

                return $key . ";" . $value ;

        }

    }
    
    function visitText(\cmu\html\form\products\Input $component)

    {

        return $this->returnKeyValue($component->getValue(), $component->getName(), $component->getValue() );

    }

    function visitRadio(\cmu\html\form\products\Input $component)

    {

        return $this->returnKeyValue($component->getChecked(), $component->getName(), $component->getValue() );

    }

    function visitCheckbox(\cmu\html\form\products\Input $component)

    {

        return $this->returnKeyValue($component->getChecked(), $component->getName(), $component->getValue() );

    }

    function visitHidden(\cmu\html\form\products\Input $component)

    {

        return $this->returnKeyValue($component->getValue(), $component->getName(), $component->getValue() );

    }

    function visitPassword(\cmu\html\form\products\Input $component)

    {

        return $this->returnKeyValue($component->getValue(), $component->getName(), $component->getValue() );

    }

}