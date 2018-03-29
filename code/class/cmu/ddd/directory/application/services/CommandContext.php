<?php
namespace cmu\ddd\directory\application\services;

class CommandContext

{  

    private $params = array();
 
    function addParams(array $array_in)

    {

        $this->params = $array_in;

    }
 
    function addParam( string $key, $val ) 

    {
 
       $this->params[$key] = $val;
    
    }
 
    function get( $key ) 

    {

		return $this->params[$key] ?? null;

//        if ( isset( $this->params[$key] ) ) {
//
//            return $this->params[$key];
//
//        }
//
//        return null;

    }

}
