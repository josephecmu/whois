<?php
/*
 *
 * Value Object AndrewID
 *
 */
namespace cmu\ddd\directory\domain\model\actors\people;

class UidNumber extends \cmu\ddd\directory\domain\model\lib\AbstractImmutable

{
		private $uidnumber;

		function __construct (int $auidnumber) 

		{

			$validator=["validInteger"];

			if ($this->isValid("uidnumber", $auidnumber, $validator)) {			

					$this->uidnumber = $auidnumber;
		
			}
		}

		public function getUidnumber () : int 
		
		{

			return $this->uidnumber;

		}

}
