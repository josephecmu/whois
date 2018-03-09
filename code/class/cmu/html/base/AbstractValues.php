<?php
namespace cmu\html\base;
 
abstract class AbstractValues

{

    protected $values;

    function setValues(array $values_in)

    {

        $this->values = $values_in;

    }

    function getValues() 
    
    {

        return $this->values;

    }

    function getValue($key)

    {

        if ( isset( $this->values[$key] ) ) {

            return $this->values[$key];

        }
	//	echo "WRONG VALUE";
        return null;

    }

}
