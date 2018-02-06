<?php 
namespace cmu\html\form\visitors\input;

class ValidateInputVisitor extends AbstractInputVisitor

{
    //default
    function visit(\cmu\html\form\products\Input $component)

    {

       return true;
        
    }
    //helper function to use below.  Should be default implimentation
    private function checkFilterSet($component)

    {

        if (null !== $component->getFiltertype()) {
            
            $validator = new \cmu\html\form\validate\ValidatorContext($component->getFiltertype());

            if ($validator->validateText($component->getValue(), $component->getValidateaginst())) {

                return true;

            } else {

                $component->setErrormessage($validator->getErrorMessagesString());  //set Fielderrormessage in $component
                
            }

        } else {  //no filter set

            return true;

        }

    }

    function visitText(\cmu\html\form\products\Input $component)

    {

        return $this->checkFilterSet($component);  //from above

    }

    function visitPassword(\cmu\html\form\products\Input $component)

    {

         return $this->checkFilterSet($component);  //from above

    }

    function visitHidden(\cmu\html\form\products\Input $component)

    {

         return true;

    }

}