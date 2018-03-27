<?php
/*
 *Value Object
 *
 */
namespace cmu\ddd\directory\domain\model\actors\people;

class Name extends \cmu\ddd\directory\domain\model\lib\AbstractImmutable
{

		protected $firstname;
		protected $middlename;
		protected $lastname;
		protected $suffixname;

		function __construct ( array $aname) 

		{

			if ($this->isValid("firstname", $aname["firstname"],["validlettersonly"])) {

				$this->firstname = $aname["firstname"];

			}

			if ($this->isValid("lastname", $aname["lastname"],["notNull"])) {

				$this->lastname = $aname["lastname"];

			}

			$this->middlename = $this->middlename ?? null;
			$this->suffixname = $this->suffixname ?? null;

		}

}
