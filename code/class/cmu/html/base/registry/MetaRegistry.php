<?php 
namespace cmu\html\base\registry;

class MetaRegistry extends AbstractRegistry 

{

    static function getMeta() 

    {

        $inst = self::getInstance();

        if ( is_null( $inst->get( "meta" ) ) ) {

            $inst->set('meta', new \cmu\html\base\Meta() );
        }

        return $inst->get( "meta" );

    }

}