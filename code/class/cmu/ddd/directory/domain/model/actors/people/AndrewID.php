<?php

/*
 *
 * Value Object AndrewID
 *
 */
namespace cmu\ddd\directory\domain\model\actors\people;

class AndrewID extends \cmu\ddd\directory\domain\model\lib\AbstractImmutable

{
		private $andrewid;

		function __construct (string $anid) 

		{

			$validator=["validLCaseString"];

			if ($this->isValid("andrewid", $anid, $validator)) {			

					$this->andrewid = $anid;
		
			}
		}

		public function getAndrewid () : string 
		
		{

			return $this->andrewid;

		}

}
