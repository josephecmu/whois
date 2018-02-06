<?php
namespace cmu\html\general\visitors;

abstract class AbstractVisitor extends \cmu\html\visitors\AbstractVisitor

{
    
    function visitA(\cmu\html\general\products\A $component)

    {

        $this->visit($component);

    }

    function visitDiv(\cmu\html\general\products\Div $component)

    {

        $this->visit($component);

    }

    function visitSpan(\cmu\html\general\products\Span $component)

    {

        $this->visit($component);

    }

}