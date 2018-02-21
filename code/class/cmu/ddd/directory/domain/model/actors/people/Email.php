<?php
/*
 *Value Object
 *
 */
namespace cmu\ddd\directory\domain\model\actors\people;

class Email extends \cmu\ddd\directory\domain\model\lib\AbstractImmutable
{

		protected $email = [];

		function __construct ( array $email) 

		{

			$this->email = $email;

		}

}
