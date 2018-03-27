<?php

namespace cmu\ddd\directory\domain\model\lib;

trait TraitValidator
{
	protected function isValid ($key, $value, array $validators )

	{
			foreach ($validators as $validator) {

					return $this->$validator($key, $value);	

			}	
	}			

	protected function validAll ($key, string $string)  {
			return true;
	}

	protected function notNull ($key, $value)  {

			if ( $value === null) {

				throw new \InvalidArgumentException("$key can not be null");
			}
			return true;
	}
	
	protected function validLettersOnly ($key, string $string) 	{
			if (!preg_match("/^[a-zA-Z'-]+$/",$string)) {
					 throw new \InvalidArgumentException("$key:: pattern does not match");
			} 

			return true;

	}

	protected function validPath ($key, string $string ) {
			if (!preg_match("/[\/a-zA-Z0-9]+/", $string)) {
					 throw new \InvalidArgumentException("$key is **Not a valid path**");
			}
				
			return true;
	}

	protected function validInteger ($key, string $string) {
			if((!filter_var($string, FILTER_VALIDATE_INT))) {
				throw new \InvalidArgumentException("**$key:: Id pattern does not match --1000+ and integer**");	
			}
			
			return true;
	}
	
	protected function validLCaseString ($key, string $string ) {

		if (!preg_match("/^[a-z]+$/",$string)) {
				throw new \InvalidArgumentException("$key:: Name pattern does not match");
		}
	
			return true;
	}

}
