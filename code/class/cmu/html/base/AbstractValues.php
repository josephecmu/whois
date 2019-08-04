<?php
namespace cmu\html\base;
 
abstract class AbstractValues

{

    protected $values = [];

    function setValues(array $values_in) //void

    {

        $this->values = $values_in;

    }

    function getValues() : array
    
    {

		return $this->values ?? [] ;

    }

    function getValue($key)

    {

		return $this->values[$key] ?? null;	

	}		

	//3/28/18
	public function contains(string $search_key) : bool
	{

		foreach ($this->values as $key => $value)
		{
			if (strpos($key, $search_key) !== false) {
				return true;
			}
		}

		return false;

	}
}
