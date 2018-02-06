<?php 
namespace cmu\html\base\registry;

class RequestRegistry extends AbstractRegistry 

{
 
    static function getRequest() {

        $inst = self::getInstance();

        if ( is_null( $inst->get( "request" ) ) ) {

            $inst->set('request', new \cmu\html\base\Request() );
        }

        return $inst->get( "request" );

    }

}