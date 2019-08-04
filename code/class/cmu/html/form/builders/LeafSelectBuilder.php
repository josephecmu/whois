<?php 
namespace cmu\html\form\builders;

use \cmu\html\form\products\Select;

class LeafSelectBuilder extends AbstractLeafBuilder

{

    function returnLeaf() : array

    {

        $n = (!empty(self::$valuesarray)) ? count(self::$valuesarray) : 1 ;  //cycle based on VALUES, if none, cycle once.

        for ($i = 0; $i < $n; $i++) { 

        $this->obj = new Select;

            if (isset(self::$valuesarray)) { //value is equal to checked per <option> group

                $this->changeProperty('replace','selectedvalue', array_values(self::$valuesarray)[$i]);

            }
    
        $this->arrayChangeProperty();
    
        $this->setProperty();

        $objects[] = $this->obj;

        }
	
		return $objects;

    }

}
