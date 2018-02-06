<?php 
namespace cmu\html\base;

class Request extends AbstractValues {  //grabs all requests and placed into STATIC array

    function __construct() 

    {

        $this->init();
 
    }
 
    private function init()  //added scope

    {                  

        if ( isset( $_SERVER['REQUEST_METHOD'] ) ) {

            $this->values = $_REQUEST;

            return;
        }
 
        foreach( $_SERVER['argv'] as $arg ) {

            if ( strpos( $arg, '=' ) ) {

                list( $key, $val ) = explode( "=", $arg );

                $this->setProperty( $key, $val );  		            //called in parent

            }

        }

    }

    function returnNormalizeProperties() : array

    {

        $values_copy = array();

            foreach ($this->values as $k => $v) {
                 
                if (!is_array($v)) {						            //check if array
            
                    $values_copy[$k] = array($v);		            //make the value an array
            
                } else {

                    $values_copy[$k] = $v;                          //assign

                }
                 
            }

        return $values_copy;

    }

}