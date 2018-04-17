<?php 
namespace cmu\html\form\builders;

use \cmu\html\form\products\Input;

class LeafCheckboxBuilder extends AbstractLeafBuilder

{

    function returnLeaf() : array

    {
        //checkbox/////////////////////////////////////////////////////////////////////////////////////
        //we must iterate based on OPTIONS available to the user (possible Values)
        if (!isset(self::$optionsarray)) {
            //by default if not options array specified, it is the it is the 'value'
            self::$optionsarray = self::$elementarray['value'];            //needs tested.

        }

        $n = count(self::$optionsarray) ;

        for ($i = 0; $i < $n; $i++) { 

            $this->obj = new Input;
            //below will check for value and set CHECKED
            $this->changeProperty('replace', 'value', array_values(self::$optionsarray)[$i]);

            $this->changeProperty('replace', 'caption', array_values(self::$optionsarray)[$i]);

            if (isset(self::$valuesarray)) {
                //if the value='value' is in the array of values pulled from DB, it should be checked
                if (in_array(array_values(self::$optionsarray)[$i], self::$valuesarray )) {

                $this->changeProperty('replace', 'checked', 'checked');
                //this will set the checked value in the object for access via the confirmForm
                $this->changeProperty('replace', 'checkedvalue', array_values(self::$optionsarray)[$i]);

                }

            }

            $this->arrayChangeProperty();
        
            $this->setProperty();

            $objects[] = $this->obj;

        }

        return $objects;

    }

}