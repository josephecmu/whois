<?php
namespace cmu\html\form\validate;

class ValidatorEmail extends AbstractValidator

{
    
    public function validateInput()

    {

        if (filter_var($this->input, FILTER_VALIDATE_EMAIL)) {

            return true;
        
        } else {

            $this->setErrorMessage("INVALID EMAIL");

        }

    }

}