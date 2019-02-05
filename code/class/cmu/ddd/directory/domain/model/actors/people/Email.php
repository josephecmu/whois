<?php
/*
 *Value Object
 *
 */
namespace cmu\ddd\directory\domain\model\actors\people;

use \cmu\ddd\directory\domain\model\lib\AbstractImmutable;


namespace cmu\ddd\directory\domain\model\actors\people;

class Email extends AbstractImmutable
{
	protected $email = [];

	function __construct (array $email) 
	{
		$this->email = $email;
	}
}
