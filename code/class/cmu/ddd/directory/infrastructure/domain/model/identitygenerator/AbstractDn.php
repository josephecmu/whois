<?php 

namespace cmu\ddd\directory\infrastructure\domain\model\identitygenerator;

use cmu\config\site\bin\TraitConfig;

abstract class AbstractDn
{
	
	use TraitConfig;

	protected $dc = "dc=mcs,dc=cmu,dc=edu";
	protected $options;

	function __construct()
	{
		$this->options = $this->getConfigArray("config.ini");		
	}

	abstract public function buildDn (string $id) : string;

}
