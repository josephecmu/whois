<?php
namespace cmu\html\form\validate;

class ValidatorUrlDomain extends AbstractValidator

{
    
    public function validateInput()

    {
        //this should support domain.topdomain, but does not .  NEEDS WORK
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$this->input)) {

            return true;
        
        } else {

            $this->setErrorMessage("INVALID URL/DOMAIN NAME");

        }

    }

}