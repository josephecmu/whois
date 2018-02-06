<?php 
namespace cmu\html\base\registry;

class LdapValuesRegistry extends AbstractRegistry 

{
 
    static function getLdapValues() 

    {

        $inst = self::getInstance();

        if ( is_null( $inst->get( "ldap_values" ) ) ) {

            $inst->set('ldap_values', new \cmu\html\base\LdapValues() );
        }

        return $inst->get( "ldap_values" );

    }

}