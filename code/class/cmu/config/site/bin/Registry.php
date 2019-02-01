<?php

namespace cmu\config\site\bin;

class Registry

{

	private static $instance = null;
	private $ldap = null; //this object is the class "LdapWrapper" since not 'PDO' class exists.
	private $conf = null;

	private function __construct() {}

	public static function instance(): self
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public static function reset() : void
	{
		self::$instance = null;
	}

	public function setConf(Conf $conf) : void
	{
		$this->conf = $conf;
	}

	public function getConf(): Conf
	{
		if (is_null($this->conf)) {
			$this->conf = new Conf();
		}

		return $this->conf;
	}

	public function getPass() : string
	{
		$conf = $this->getConf();
		return $conf->get("pass");
	}

	public function getCred() : string
	{
		$conf = $this->getConf();
		return $conf->get("cred"); 
	}

	public function getHost() : string
	{
		$conf = $this->getConf();
		return $conf->get("host"); 
	}

	public function getPort(): int
	{
		$conf = $this->getConf();
		return $conf->get("port"); 
	}
	public function getDn(): string
	{
		$conf = $this->getConf();
		return $conf->get("dn"); 
	}

}
