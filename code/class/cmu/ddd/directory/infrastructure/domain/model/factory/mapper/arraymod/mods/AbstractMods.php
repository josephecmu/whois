<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;

abstract class AbstractMods
{

	protected $temp = [];

	protected $obj; //the Abstract Mapper Object

	function __construct(AbstractMapper $obj)
	{
		$this->obj = $obj;

	}

	public function returnTemp() : array
	{
		return $this->temp;
	}

}
