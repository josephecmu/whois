<?php
namespace cmu\html\table\visitors;

abstract class AbstractVisitor extends \cmu\html\visitors\AbstractVisitor

{
    //specific implimentation to call general above
    function visitCaption(\cmu\html\table\products\Caption $component)

    {

        $this->visit($component);

    }

    function visitClosetag(\cmu\html\table\products\CloseTag $component)

    {

        $this->visit($component);

    }

    function visitCol(\cmu\html\table\products\Col $component)

    {

        $this->visit($component);

    }

    function visitColgroup(\cmu\html\table\products\Colgroup $component)

    {

        $this->visit($component);

    }

    function visitCompositeTable(\cmu\html\table\products\CompositeTable $component)

    {

        $this->visit($component);

    }

    function visitTbody(\cmu\html\table\products\Tbody $component)

    {

        $this->visit($component);

    }

    function visitTd(\cmu\html\table\products\Td $component)

    {

        $this->visit($component);

    }
    
    function visitTfoot(\cmu\html\table\products\Tfoot $component)

    {

        $this->visit($component);

    }
    
    function visitTh(\cmu\html\table\products\Th $component)

    {

        $this->visit($component);

    }

    function visitThread(\cmu\html\table\products\Thread $component)

    {

        $this->visit($component);

    }

    function visitTr(\cmu\html\table\products\Tr $component)

    {

        $this->visit($component);

    }

}