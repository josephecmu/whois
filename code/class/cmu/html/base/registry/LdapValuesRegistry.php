<?php 
namespace cmu\html\base\registry;

use \cmu\html\base\LdapValues;

class LdapValuesRegistry extends AbstractRegistry 

{
 
    static function getLdapValues() : LdapValues

    {

        $inst = self::getInstance();

        if ( is_null( $inst->get( "ldap_values" ) ) ) {

            $inst->set('ldap_values', new LdapValues );
        }

        return $inst->get( "ldap_values" );

    }

}
