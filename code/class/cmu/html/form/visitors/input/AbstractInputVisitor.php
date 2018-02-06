<?php 
namespace cmu\html\form\visitors\input;

class AbstractInputVisitor 
{
    //Special Visitor for INPUT control based on TYPE
    //default implimentation for objects that require no action
    function visit(\cmu\html\form\products\Input $component)

    {

        null;
        
    }
    //specific implimentation to call general above for all avaialble INPUT TYPE possibilities
    function visitText(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

    function visitRadio(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

    function visitCheckbox(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

    function visitButton(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

    function visitSubmit(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

    function visitHidden(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

    function visitImage(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

    function visitReset(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

    function visitPassword(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

    function visitFile(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

}