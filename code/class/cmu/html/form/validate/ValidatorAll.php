<?php
namespace cmu\html\form\validate;

class ValidatorAll extends AbstractValidator

{
    
    public function validateInput()

    {
        //matches everything
        if (preg_match("/./", $this->input)) {
          
            return true;
            
        }

    }

}