<?php

namespace cmu\ddd\directory\infrastructure\domain\model\share;

use cmu\config\site\bin\Conf;

trait TraitConfig

{

	protected $conf;      			//returns object that stores ini data of above maps
	protected $ini; 		     	// ini file to read	

	protected function setIniFile(string $file)
	{

		$this->ini = CONFDIR . $file;	

	}

	protected function returnParseIniFile() : array //return $options
	{

		return parse_ini_file($this->ini, true);

	}

	protected function returnConfigObject($options) : Conf
	{

		return Conf($options);

	}

	//$this->conf = $this->getConfig($factory, $options); 

}
