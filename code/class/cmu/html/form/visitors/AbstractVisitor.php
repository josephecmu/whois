<?php
namespace cmu\html\form\visitors;

abstract class AbstractVisitor extends \cmu\html\visitors\AbstractVisitor

{
    //used for Input 'child' visitors
    protected function accept( \cmu\html\form\visitors\input\AbstractInputVisitor $visitor, \cmu\html\form\products\Input $component)

    {
        //get TYPE converted to upper case
        $type = ucfirst( $component->getType() );
        //build method   visit + type (from above)
        $method = "visit" . $type;
        //return the values from the new object function
        return $visitor->$method($component);

    }
    //specific implimentation to call general above
    function visitInput(\cmu\html\form\products\Input $component)

    {

        $this->visit($component);

    }

    function visitTextArea(\cmu\html\form\products\TextArea $component)
    
    {

        $this->visit($component);

    }

    function visitSelect(\cmu\html\form\products\Select $component)

    {

        $this->visit($component);

    }

    function visitButton(\cmu\html\form\products\Button $component)

    {

        $this->visit($component);

    }

    //function visitLabel(\cmu\html\form\products\Label $component)

    //{

        //$this->visit($component);

    //}

    //function visitDatalist(\cmu\html\form\products\Datalist $component)

    //{

        //$this->visit($component);

    //}

    function visitCompositeForm(\cmu\html\form\products\CompositeForm $component)

    {

        $this->visit($component);

    }

    function visitCompositeControl(\cmu\html\form\products\CompositeControl $component)

    {

        $this->visit($component);

    }
    
    //function visitFieldset(\cmu\html\form\products\Fieldset $component)  //we now use reflection to scheck only AbstractControl classes

    //{

        //$this->visit($component);

    //}
    
    //function visitLegend(\cmu\html\form\products\Legend $component)

    //{

        //$this->visit($component);

    //}

    //function visitCloseTag(\cmu\html\form\products\CloseTag $component)

    //{

        //$this->visit($component);

    //}
    
}