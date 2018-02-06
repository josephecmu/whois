<?php
namespace cmu\html\form\validate;

class ValidatorLetterspunct extends AbstractValidator

{
    //only allow Letters, Periods, and Spaces
    public function validateInput()

    {

        if (preg_match("/^[a-zA-Z\.\s]+$/", $this->input)) {

            return true;
        
        } else {

            $this->setErrorMessage("ONLY LETTERS and PERIOD ALLOWED");

        }

    }

}