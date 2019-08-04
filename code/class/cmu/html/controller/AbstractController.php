<?php 
namespace cmu\html\controller;

abstract class AbstractController {

    abstract function process();

    function forward( $resource ) {

        include( $resource );

        exit( 0 );
 
    }
 
}
