<?php 
namespace cmu\html\base\registry;

abstract class AbstractRegistry

{

    protected static $instances = array();
    protected $values = array();


    protected function __construct() { }

    protected function __clone() { }
 
    public static function getInstance()

    {
        
        //LATE STATIC BINDING///////////
        $class = get_called_class();                                // resolves the called class at run time

        if (!isset(self::$instances[$class])) {

            self::$instances[$class] = new $class;

        }
        return self::$instances[$class];

    }  

    function get( $key ) 

    {

		return  $this->values[$key] ?? null;

    }
 
    function set( $key, $val ) 

    {

        $this->values[$key] = $val;

    }

    function getValues() : array							                    //return whole array

    {

        return $this->values;

    }

    function setValues($values_in)

    {

        $this->values = $values_in;

    }

    function clear()

    {

        $this->values = array();                                            //reset the array

    }

}
