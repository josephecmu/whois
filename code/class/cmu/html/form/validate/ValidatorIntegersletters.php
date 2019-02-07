<?php
namespace cmu\html\form\validate;

class ValidatorIntegersletters extends AbstractValidator
{
    
    public function validateInput() : bool
    {
		if (preg_match("/^[a-zA-Z0-9]+$/", $this->input)) {
            return true;
        } else {
			$this->setErrorMessage("Only Letters and Number Allowed");
			return false;
        }
    }
}
