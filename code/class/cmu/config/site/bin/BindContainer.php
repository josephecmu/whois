<?php

namespace cmu\config\site\bin;

class BindContainer

{

	private $pass;
	private $cred;
	private $host;
	private $port;
	private $dn;

	static $ds;
	private $r;

	function __construct() 

	{

		$conf = ApplicationHelper::getLdapConf();
		$this->pass = $conf->get('pass');
		$this->cred = $conf->get('cred');
		$this->host = $conf->get('host');
		$this->port = $conf->get('port');
		$this->dn   = $conf->get('dn');

		echo $this->host;
		echo $this->port;	
	//		$this->ds = $this->setDs();

		//if ( $this->ds == null ) {
		self::$ds = ldap_connect($this->host, $this->port);			
		//}
//			echo $this->ds;

	}

	private function setDs()

	{

		if ( $this->ds == null ) {
			return ldap_connect($this->host, $this->port);			
		}

	}

	public static function getDs()  //Returns a positive LDAP link identifier when the provided combination  seems plausible.

	{

		return self::$ds;
	}

    public function getR()  //returns connection handle

    {

		if ($this->r == null) {

			try {

				ldap_set_option($this->ds, LDAP_OPT_PROTOCOL_VERSION, 3);
				// bind with appropriate dn to give update access
				$this->r = ldap_bind($this->ds, $this->cred, $this->pass );
				//return ldap_bind($this->ds, $this->cred, $this->pass );

			} catch (Exception $e) {

				echo "error, can't bind!!!!";
	
			}

		} 

		return $this->r;

    }
	
}
