<?php
namespace cmu\html\form\visitors;

class ValidateVisitor extends AbstractVisitor

{
    
    /*
     * 
     * name: cmu\html\form\visitors::ValidateVisitor::visitInput
     * @param \cmu\html\form\products\Input $component
     * @return True or Validate if Text
     * 
     */
    function visitInput(\cmu\html\form\products\Input $component)

    {
         ////Call secondary VISITOR to handle input TYPES (text, submit, radio, etc)
        $visitor = new \cmu\html\form\visitors\input\ValidateInputVisitor;
    
        return $this->accept($visitor, $component);

    }
    /*
     * 
     * name: cmu\html\form\visitors::ValidateVisitor::visitCompositeForm
     * @param \cmu\html\form\products\CompositeForm $component
     * @return TRUE or null
     * 
     */
    function visitCompositeForm(\cmu\html\form\products\CompositeForm $component)

    {
        
        if ($component->getError() < 1) {

			return true;

		}

    }

    function visitTextArea(\cmu\html\form\products\TextArea $component)
    
    {
        //we can only validate TEXT input
        if (null !== $component->getFiltertype()) {

            $validator = new \cmu\html\form\validate\ValidatorContext($component->getFiltertype());

            if ($validator->validateText($component->getText())) {

                    return true;

            } else {

                $component->setErrormessage($validator->getErrorMessagesString()); //set Fielderrormessage in $component

            }
        //no filter to check against
        } else {

            return true;

        }

    }

    function visitCompositeControl(\cmu\html\form\products\CompositeControl $component)
    
    {
    
        if ($component->getCountSet() >= $component->getReqnumber()) {

            return true;

        }
        
    }

    function visitSelect(\cmu\html\form\products\Select $component)
    
    {

        if (null != $component->getSelectedvalue()) {  ///////untested

            return true;
        
        }

    }

    function visitButton(\cmu\html\form\products\Button $component)
    
    {

        return true;

    }

}