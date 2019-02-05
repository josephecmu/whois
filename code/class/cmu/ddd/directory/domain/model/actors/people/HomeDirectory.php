<?php

/*
 *
 * Value Object AndrewID
 *
 */
namespace cmu\ddd\directory\domain\model\actors\people;

use \cmu\ddd\directory\domain\model\lib\AbstractImmutable;

class HomeDirectory extends AbstractImmutable
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
