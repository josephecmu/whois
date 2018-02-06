<?php 
namespace cmu\html\controller;

abstract class AbstractController {

    abstract function process();

    function forward( $resource ) {

        include( $resource );

        exit( 0 );
 
    }
 
    //function getRequest() {

    //    return \cmu\html\registry\RequestRegistry::getRequest();

    //}

    //function getMeta() {

     //   return \cmu\html\registry\MetaRegistry::getMeta();

    //}

}