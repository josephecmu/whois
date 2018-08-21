<?php

namespace cmu\ddd\directory\domain\model\lib;

class Dn extends AbstractImmutable
{
		protected $dn;

		function __construct(string $adn ) 

		{

			$validators= ["validAll"];

			if ($this->isValid('The entity DN', $adn, $validators)) {

				$this->dn = $adn;

			}

		}

		public function getDn() : string
		{
		
			return $this->dn;

		}

}
