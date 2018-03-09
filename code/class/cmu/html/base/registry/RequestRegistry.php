<?php 
namespace cmu\html\base\registry;

use \cmu\html\base\Request;

class RequestRegistry extends AbstractRegistry 

{
 
	static function getRequest() : Request 
	
	{

        $inst = self::getInstance();

        if ( is_null( $inst->get( "request" ) ) ) {

            $inst->set('request', new Request );
        }

        return $inst->get( "request" );

    }

}
