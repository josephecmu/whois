<?php

namespace cmu\ddd\directory\infrastructure\domain\model\share;

use cmu\config\site\bin\Conf;

trait TraitConfig

{

	abstract protected function returnConcreteConfigObject( array $options) : Conf;

	private function returnIniFile(string $file) : string
	{

		$fileandpath = CONFDIR . $file;

		if (! file_exists($fileandpath)) {
			throw new AppException("Could not find options file");
			echo "Could not find options file";
		}

		return $fileandpath;
	}

	protected function getConfigArray(string $file) : array 					//return the parsed .ini file
	{

		$ini = $this->returnIniFile($file);
		return parse_ini_file($ini, true);
	}

	protected function returnConfigObject( array $options) : Conf				//return Conf object, with specified [section] (people,etc.)
	{

		return new Conf($options);

	}

}
