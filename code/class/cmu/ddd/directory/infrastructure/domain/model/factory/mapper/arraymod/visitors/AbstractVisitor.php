<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\visitors;

use \cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;
use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\Mod; 

abstract class AbstractVisitor
{

	protected $mod;					//Mod object

	function __construct(AbstractMapper $mapper, array $raw_in = null)
	{

		$raw = ($raw_in) ?: $mapper->getRaw();

		$this->mod = new Mod($mapper, $raw);

	}

	abstract public function returnConvertedArray() : array;

}
