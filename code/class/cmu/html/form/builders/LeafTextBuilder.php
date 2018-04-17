<?php 
namespace cmu\html\form\builders;

use \cmu\html\form\products\Input;

class LeafTextBuilder extends AbstractLeafBuilder

{

    function returnLeaf() : array

    {
        
        $n = (!empty(self::$valuesarray)) ? count(self::$valuesarray) : 1 ;

        for ($i = 0; $i < $n; $i++) { 

        $this->obj = new Input;

            if (isset(self::$valuesarray)) { //only print values if values array exists

                $this->changeProperty('replace', 'value', array_values(self::$valuesarray)[$i]);

            }
    
        $this->arrayChangeProperty();
    
        $this->setProperty();

        $objects[] = $this->obj;

        }
	
		return $objects;

    }

}