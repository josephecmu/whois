<?php

namespace cmu\ddd\directory\infrastructure\domain\model\factory\mapper\arraymod\mods;

use cmu\ddd\directory\infrastructure\domain\model\factory\mapper\AbstractMapper;

abstract class AbstractMods
{

	protected $obj; //the Abstract Mapper Object
	protected $temp = [];

	function __construct(AbstractMapper $obj)
	{
		$this->obj = $obj;
	}

	abstract public function modify($k, $v);

	public function act_on_single_array_depth(array $array)
	{
		//empty out $this->temp
		$this->temp = [];
		foreach ($array as $k => $v) {

			$this->modify($k, $v);	

		}

	}

	public function returnTemp() : array
	{
		return $this->temp;
	}

}
