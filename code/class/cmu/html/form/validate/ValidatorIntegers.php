<?php
namespace cmu\html\form\validate;

class ValidatorIntegers extends AbstractValidator

{
    
    public function validateInput()

    {

        if (filter_var($this->input, FILTER_VALIDATE_INT)) {

            return true;
        
        } else {

            $this->setErrorMessage("INVALID INTEGER");

        }

    }

}