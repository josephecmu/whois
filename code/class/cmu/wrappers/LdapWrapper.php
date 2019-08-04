<?php 
namespace cmu\wrappers;
//php LDAP WRAPPER

use cmu\config\site\bin\Conf;
use cmu\config\site\bin\TraitConfig;

class LdapWrapper 
{
	use TraitConfig;

    private $ds;      	//returned by ldap_connect(server, port)
    private $r;			//returned by ldap_bind($ds, user, pass)
	
    private $dn; 		//= 'dc=mcs,dc=cmu,dc=edu';
    private $pass;		// = 'Qa.....3';
    private $cred; 		// = 'cn=admin,dc=mcs,dc=cmu,dc=edu';

    static $port; 		// =  389;
    static $host; 		// = 'localhost';

	static $reg;
//	private $conf;		//Conf object

    function __construct($ds)
    {
//		$options = $this->getConfigArray("config.ini");	
//		$this->conf = $this->returnConfigObject($options["ldap_config"]);
	    $this->ds = $ds;
		$this->setCredentials();
        $this->connect();
    }

    public static function getLdapDs()  //create $ds handle
    {
		self::setConnectionParams();
        return ldap_connect(self::$host, self::$port);
    }
    //called in constructor
    private function connect() : void
    {
        if ($this->ds) {

            ldap_set_option($this->ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            // bind with appropriate dn to give update access
            $this->r = ldap_bind($this->ds, $this->cred, $this->pass );

        } else {
            echo "error, can't bind!!!!";
        }
    }

	private static function setConnectionParams() : void
	{
		self::$reg = \cmu\config\site\bin\Registry::instance();
		self::$port = static::$reg->getPort();
		self::$host = static::$reg->getHost();
	}

	private function setCredentials() : void
	{
		$this->dn = static::$reg->getDn();
		$this->pass = static::$reg->getPass();
		$this->cred = static::$reg->getCred();
	}

    public function getDn() : string
    {
        return $this->dn;
    }
    //ldap_get_entries
    public function getEntries($r)
    {
        return $result = ldap_get_entries($this->ds, $r);
    }
    //search
    public function search($base_dn, $filter, array $attributes = array(), $attrsonly = null,  $sizelimit = null, $timelimit = null)
    {
        return ldap_search($this->ds, $base_dn, $filter, $attributes, $attrsonly,  $sizelimit, $timelimit);
    }
    //add
    public function add($rdn, array $input) : bool
    {
        echo "LdapWrapper.php Input <br>";
        print_r($input);

        return ldap_add($this->ds, $rdn, $input);
    }
    //update
    public function update($rdn, array $input) : bool
    {
        return ldap_mod_replace($this->ds, $rdn, $input);
    }
    //delete
    public function delete($rdn) : bool
    {
        return ldap_delete($this->ds, $rdn);
    }

	function close() : void
	{
		ldap_close($this->ds);
	}

}
