<?php
/*
 *
 * Value Object AndrewID
 *
 */
namespace cmu\ddd\directory\domain\model\actors\people;

use \cmu\ddd\directory\domain\model\lib\AbstractImmutable;

class GidNumber extends AbstractImmutable
{
	private $gidnumber;

	function __construct (int $agidnumber) 
	{
		$validator=["validInteger"];
		if ($this->isValid("gidnumber", $agidnumber, $validator)) {			
				$this->gidnumber = $agidnumber;
		}
	}

	public function getGidnumber () : int 
	{
		return $this->gidnumber;
	}
}
