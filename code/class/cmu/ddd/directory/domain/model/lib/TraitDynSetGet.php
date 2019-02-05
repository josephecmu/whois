<?php 
/**
 * 
 *
 * the methods below allow for custom called accessors in children if they exist, otherwise the properties are accessed directly.
 *
 */
namespace cmu\ddd\directory\domain\model\lib;

Trait TraitDynSetGet
{
    //"dynamic" accessors from https://www.sitepoint.com/implementing-a-unit-of-work/
	protected function dynSet($name, $value)//we call the setter in the child class
	{                              

        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException("**Property does not exist**" . "  " . $name);
        }

        $mutator = "set" . ucfirst(strtolower($name));

        if (method_exists($this, $mutator)) {
            return $this->$mutator($value);
        } 

        $this->$name = $value;                                                  //no setter method, just assign value.
    }
    
	public function dynGet($name) : string
	{
        if ($this->$name === null) {
            throw new \InvalidArgumentException("**empty property**" . $name);
        }

        $accessor = "get" . ucfirst($name);

        if (method_exists($this, $accessor)) {
			return $this->$accessor();
        } 
        return $this->$name;                                                    //no getter method, just return the value.
    }
    
	public function dynIsset($name) :bool 
	{
	    return isset($this->$name);
    } 

}
