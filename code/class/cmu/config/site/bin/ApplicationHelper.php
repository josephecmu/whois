<?php
//this is called from the global config file whois.conf
namespace cmu\config\site\bin;

class ApplicationHelper

{

	private $config = __DIR__ . "/../config.ini";
	private $reg;

	public function __construct()
	{
		$this->reg = Registry::instance();
	}

	public function init() : void
	{
		$this->setupOptions();
	}
	
	private function setupOptions() : void
	{
		if (! file_exists($this->config)) {
			throw new AppException("Could not find options file");
			echo "Could not find options file";
		}

		$options = parse_ini_file($this->config, true);

		$conf = new Conf($options['ldap_config']);

		$this->reg->setConf($conf);
	}

}
