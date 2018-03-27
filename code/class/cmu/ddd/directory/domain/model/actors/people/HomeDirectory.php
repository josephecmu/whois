<?php

/*
 *
 * Value Object AndrewID
 *
 */
namespace cmu\ddd\directory\domain\model\actors\people;

class HomeDirectory extends \cmu\ddd\directory\domain\model\lib\AbstractImmutable

{
		private $homedirectory;

		function __construct(string $ahomedirectory) 

		{

//			$validator=["validLCaseString"];

//			if ($this->isValid("andrewid", $anid, $validator)) {			

					$this->homedirectory= $ahomedirectory;
		
//			}
		}

		public function getHomedirectory () : string 
		
		{

			return $this->homedirectory;

		}

}
