<?php 
namespace cmu\html\form\builders;

class LeafTextBuilder extends AbstractLeafBuilder

{

    function returnLeaf()

    {
        
        $n = (!empty(self::$valuesarray)) ? count(self::$valuesarray) : 1 ;

        for ($i = 0; $i < $n; $i++) { 

			$this->obj = new \cmu\html\form\products\Input;

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
