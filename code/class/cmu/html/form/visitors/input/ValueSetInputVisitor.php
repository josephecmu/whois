<?php
namespace cmu\html\form\visitors\input;

class ValueSetInputVisitor extends AbstractInputVisitor

{
    //default
    function visit(\cmu\html\form\products\Input $component)

    {

        return true;
        
    }

    function visitText(\cmu\html\form\products\Input $component)

    {

        if (null != $component->getValue()) {

                return true;

        }

    }

    function visitRadio(\cmu\html\form\products\Input $component)

    {

       if (null != $component->getChecked() ) {

                return true;

        }

    }

    function visitCheckbox(\cmu\html\form\products\Input $component)

    {

        if (null != $component->getChecked() ) {

                return true;

        }

    }

    function visitHidden(\cmu\html\form\products\Input $component)

    {

        if (null != $component->getValue()) {

                return true;

        }

    }

    function visitPassword(\cmu\html\form\products\Input $component)

    {

        if (null != $component->getValue()) {

                return true;

        }

    }

}