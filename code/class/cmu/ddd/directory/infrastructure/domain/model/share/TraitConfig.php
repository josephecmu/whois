<?php

namespace cmu\ddd\directory\infrastructure\domain\model\share;

use cmu\config\site\bin\Conf;

trait TraitConfig

{

	protected $ini; 		     	// ini file to read	

	abstract protected function returnConcreteConfigObject( array $options) : Conf;

	protected function setIniFile(string $file)
	{

		$this->ini = CONFDIR . $file;	
		//we need sanity check on existance of file
	}

	protected function returnParseIniFile() : array //return $options
	{

		return parse_ini_file($this->ini, true);

	}

	protected function returnConfigObject( array $options) : Conf
	{

		return new Conf($options);

	}

}
