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

//		print_r($this->conf);

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
    private function connect()

    {

        if ($this->ds) {

            ldap_set_option($this->ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            // bind with appropriate dn to give update access
            $this->r = ldap_bind($this->ds, $this->cred, $this->pass );

        } else {

            echo "error, can't bind!!!!";

        }

    }

	private static function setConnectionParams()

	{

		self::$reg = \cmu\config\site\bin\Registry::instance();

		self::$port = static::$reg->getPort();
		self::$host = static::$reg->getHost();

	}

	private function setCredentials()

	{

		$this->dn = static::$reg->getDn();
		$this->pass = static::$reg->getPass();
		$this->cred = static::$reg->getCred();

	}

    public function getDn()

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
    public function add($rdn, array $input)

    {

        return ldap_add($this->ds, $rdn, $input);

    }
    //update
    public function update($rdn, array $input)

    {

        return ldap_mod_replace($this->ds, $rdn, $input);

    }
    //delete
    public function delete($rdn)

    {

        return ldap_delete($this->ds, $rdn);

    }


	function close()
	{
		ldap_close($this->ds);
	}

    private function getSubschema($ds) : array

    {

        $search = ldap_read($ds, "", "objectclass=*", array('subschemasubentry'));
        
        $entries = ldap_get_entries($ds, $search);

        $schemadn = $entries[0]["subschemasubentry"][0];

        $filter = "objectClass=subSchema";

        $sr = ldap_read($ds, $schemadn, $filter, array('objectclasses'));    //DS, DN, $filter, attributes (blank), [int] attrsonly

        return ldap_get_entries($ds, $sr );

    }

    function getAttributes($objectclass)

    {

        STATIC $schema;
        STATIC $array;
        
        if (!isset($schema)) {

            $schema = $this->getSubschema($this->ds);  //call above method to return array

        }

        $count = $schema[0]["objectclasses"]["count"];

        for ($i=0; $i<$count; $i++) {

            if (strpos($schema[0]["objectclasses"][$i], $objectclass) !== false) {

                if ($objectclass == 'top') {                                            //base case//

                    foreach ($array as $k => $v) {                                      //remove 'MAY' from $array

                        if ($v == 'MAY') {

                            unset($array[$k]);

                        }

                    }
                    
                    return $array;                                                      //return final array
                    
                }

                preg_match_all('/ SUP (\w+) /', $schema[0]["objectclasses"][$i], $matches); //get 'SUP' value

                $sup = $matches[1][0];
                
                preg_match_all('/((\w)+)/', $schema[0]["objectclasses"][$i], $matches);  //get array of all words
                //check if 'MAY' exists, if so, get the key and add one (to advance the index)
                $splitkey = (in_array('MUST', $matches[0])) ? array_search('MUST', $matches[0]) + 1  :  array_search('MAY', $matches[0]) + 1 ;
               
                $slice = array_slice($matches[0], $splitkey);                           //use the key above to remove everything below it.
            
                $array = (isset($array)) ? array_merge($slice, $array) : $slice ;

                $result = $this->getAttributes($sup, $this->ds);                              //try

                if ($result) {

                    return $result;                                                     //break

                }
                
            }

        }

        return false;

    }

}
