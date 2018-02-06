<?php 
namespace cmu\html\base\registry;

class TableRowRegistry extends AbstractRegistry

{

    //probably delete

    static function getTableRow() {

        $inst = self::getInstance();

        if ( is_null( $inst->get( "tablerow" ) ) ) {

            $inst->set('tablerow', new \cmu\html\base\TableRow() );
        }

        return $inst->get( "tablerow" );

    }

}