<?php
namespace cmu\html\table\visitors;

class ReturnHtmlVisitor extends AbstractVisitor

{

    function visitCompositeTable(\cmu\html\table\products\CompositeTable $component)

    {

        $html = "<" . $component->getTag() . " ";
            
        $html .= $component->getAttributes();

        $html .= ">";

        return $html;
    
    }
    
    function visitCaption(\cmu\html\table\products\Caption $component)

    {

        $html =  "<caption ";

        $html .= $component->getAttributes();

        $html .= ">";

        $html .= $component->getCaptiontext();

        $html .= "</caption>";
    
        return $html;


    }

    function visitCloseTag(\cmu\html\table\products\CloseTag $component)

    {

        $component->getTag();

    }

    function visitCol(\cmu\html\table\products\Col $component)

    {

        $html =  "<col ";

        $html .= $component->getAttributes();

        $html .= ">";
    
        return $html;

    }

    function visitColgroup(\cmu\html\table\products\Colgroup $component)

    {

        $html =  "<colgroup ";

        $html .= $component->getAttributes();

        $html .= ">";
    
        return $html;

    }

    function visitTbody(\cmu\html\table\products\Tbody $component)

    {

        $html =  "<tbody ";

        $html .= $component->getAttributes();

        $html .= ">";
    
        return $html;

    }

    function visitTd(\cmu\html\table\products\Td $component)

    {

        $html =  "<td ";

        $html .= $component->getAttributes();

        $html .= ">";

        $html .= $component->returnTddata();

        $html .= "</td>";
    
        return $html;

    }

    function visitTfoot(\cmu\html\table\products\Tfoot $component)

    {

        $html =  "<thead ";

        $html .= $component->getAttributes();

        $html .= ">";
    
        return $html;

    }

    function visitTh(\cmu\html\table\products\Th $component)

    {

        $html =  "<th ";

        $html .= $component->getAttributes();

        $html .= ">";

        $html .= $component->getThdata();

        $html .= "</th>";
    
        return $html;

    }

    function visitThead(\cmu\html\table\products\Thead $component)

    {

        $html =  "<thead ";

        $html .= $component->getAttributes();

        $html .= ">";
    
        return $html;
     

    }

    function visitTr(\cmu\html\table\products\Tr $component)

    {

        $html =  "<tr ";

        $html .= $component->getAttributes();

        $html .= ">";
    
        return $html;   

    }

}