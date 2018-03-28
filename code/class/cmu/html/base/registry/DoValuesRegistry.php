<?php 
namespace cmu\html\base\registry;

use \cmu\html\base\DoValues;

class DoValuesRegistry extends AbstractRegistry 

{

    static function getDoValues()

    {

        $inst = self::getInstance();

		if ( is_null( $inst->get( "do_values" ) ) ) {

            $inst->set('do_values', new DoValues );
        }

        return $inst->get( "do_values" );

    }

}
