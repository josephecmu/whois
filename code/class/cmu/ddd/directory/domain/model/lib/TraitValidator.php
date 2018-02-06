<?php

namespace cmu\ddd\directory\domain\model\lib;

trait TraitValidator
{
	protected function isValid (string $string, array $validators )

	{
			foreach ($validators as $validator) {

					return $this->$validator($string);	

			}	
	}			

	protected function validAll (string $string)  {
			return true;
	}

	protected function notNull (string $string)  {

			if ( $string === null) {

				throw new \InvalidArgumentException("$string can not be null");
			}
			return true;
	}
	
	protected function validLettersOnly (string $string) 	{
			if (!preg_match("/^[a-zA-Z'-]+$/",$string)) {
					 throw new \InvalidArgumentException("pattern does not match");
			} 

			return true;

	}

	protected function validPath ( string $string ) {
			if (!preg_match("/[\/a-zA-Z0-9]+/", $string)) {
					 throw new \InvalidArgumentException("**Not a valid path**");
			}
				
			return true;
	}

	protected function validInteger (string $string) {
			if((!filter_var($string, FILTER_VALIDATE_INT))) {
				throw new \InvalidArgumentException("**Id pattern does not match --1000+ and integer**");	
			}
			
			return true;
	}
	
	protected function validLCaseString ( string $string ) {

		if (!preg_match("/^[a-z]+$/",$string)) {
				throw new \InvalidArgumentException("Name pattern does not match");
		}
	
			return true;
	}

}
