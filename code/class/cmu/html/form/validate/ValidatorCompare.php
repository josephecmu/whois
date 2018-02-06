<?php
namespace cmu\html\form\validate;

class ValidatorCompare extends AbstractValidator

{
    //validate 'value' against the RequestRegistry
    public function validateInput()

    {
    
    	$request_registry = \cmu\html\base\registry\RequestRegistry::getRequest();

        //$request = $registry->get('request');
		
		if (is_array($request_registry->getValue($this->validateagainst))) {
		
			if (in_array($this->input, $request_registry->getValue($this->validateagainst))) {		//see if array

				return true;
            
            }

        }
            
        if ($this->input == $request_registry->getValue($this->validateagainst)) {				    //it is a string

        	return true;
        
        }																	

        $this->setErrorMessage("VALUES DON'T MATCH");                                           //no matches above, set error

    }

}