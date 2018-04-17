<?php 
namespace cmu\html\form\builders;

use \cmu\html\form\products\TextArea;

class LeafTextareaBuilder extends AbstractLeafBuilder

{

    function returnLeaf() : array

    {

        $n = (!empty(self::$valuesarray)) ? count(self::$valuesarray) : 1 ;  //TEXTAREA is based on values to iterate

        for ($i = 0; $i < $n; $i++) { 

        $this->obj = new TextArea;

            if (isset(self::$valuesarray)) { //TEXT holds the value for the textarea object

                $this->changeProperty('replace', 'text', array_values(self::$valuesarray)[$i]);

            }
    
        $this->arrayChangeProperty();
    
        $this->setProperty();

        $objects[] = $this->obj;

        }
	
		return $objects;

    }

}