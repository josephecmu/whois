<?php
namespace cmu\html\base;
 
class Meta extends AbstractValues

{

    private $totalarray = [];                 	//inject meta array with values
    private $properties = [];					//the meta array without values

	function __construct(array $properties_in = null )		//added 4-9-18 to make setting easier and less code.
	{

		if (!is_null($properties_in)) {
			$this->properties = $properties_in;
		}
	}

    function getProperties() : array

    {

        return $this->properties;

    }

    function setProperties(array $array_in)

    {

        $this->properties = $array_in;

    }

    function getProperty(string $key ) 

    {    

		return $this->properties[$key] ?? null;

    }
 
    protected function setProperty( $key, $val ) //added scope

    { 

        $this->properties[$key] = $val;

    }

    function getTotalArray() : array

    {

        return $this->totalarray;
    
    }
    
    private function returnTotalArray(array $values_array, $key_name)				//**LDAP returns array with LOWERCASE KEYS $values_array
    
    {

        foreach ($this->properties as $k => $v) {                                  	//INJECT VALUES
           																			//MUST LOWER CASE KEYSin properties as ldap returns lowercase
            if ( array_key_exists(strtolower($k), $values_array) ) {                //check if we have a matching [key] in the values array

                $v[$key_name] = $values_array[strtolower($k)];                     	//inject [values]
                    
            } else {

                $v[$key_name] = null;                                               //else, the VALUE is null, but key exists

            }

            $tmp_array[$k] = $v; 													//assign to tmp_array

        }

        return $tmp_array;

    }

    function setSingleTotalArray($key_name)
    
    {

        $this->totalarray = $this->returnTotalArray($this->values, $key_name);              //return SINGLE array

    }

    function setMultiTotalArray($key_name)

    {
        $count = count($this->values);

        for ($i=0; $i<$count; $i++) {

            $this->totalarray[] =  $this->returnTotalArray($this->values[$i], $key_name);		//call method above and assign to another array for iteration of multiple records

        }

    }

}
