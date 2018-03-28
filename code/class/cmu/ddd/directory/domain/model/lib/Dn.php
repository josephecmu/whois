<?php

namespace cmu\ddd\directory\domain\model\lib;

class Dn extends AbstractImmutable
{
		protected $dn;

		function __construct( string $adn ) 

		{

			$validators= ["validAll"];

			if ($this->isValid('The entity RDN', $adn, $validators)) {

				$this->dn = $adn;

			}

		}

}
