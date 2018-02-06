<?php
namespace cmu\html\form\validate;

class ValidatorPhone extends AbstractValidator

{
    
    public function validateInput()

    {

        if (preg_match("/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/", $this->input)) {
          
            return true;
            
        } else {

            $this->setErrorMessage("INVALID PHONE NUMBER");

        }

    }
}
