<?php
namespace cmu\html\form\validate;

class ValidatorUrl extends AbstractValidator

{
    
    public function validateInput()

    {

        if (filter_var($this->input, FILTER_VALIDATE_URL)) {

            return true;
        
        } else {

            $this->setErrorMessage("INVALID URL (ex. http://domain)");

        }

    }

}