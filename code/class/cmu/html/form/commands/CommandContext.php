<?php
namespace cmu\html\form\commands;

class CommandContext

{  //do we need this with Dic?

    private $params = array();
 
    //function __construct() 
    
    //{
    
        //$this->params = $_REQUEST;
    
    //}

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

        if ( isset( $this->params[$key] ) ) {

            return $this->params[$key];

        }

        return null;

    }

}