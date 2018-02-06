<?php 
namespace cmu\html\form\builders;

class LeafRadioBuilder extends AbstractLeafBuilder

{

    function returnLeaf()

    {
        //checkbox/////////////////////////////////////////////////////////////////////////////////////
        if (!isset(self::$optionsarray)) { //we must iterate based on OPTIONS available to the user (possible Values)
            //by default if not options array specified, it is the it is the 'value'
            self::$optionsarray = self::$elementarray['value'];            /////////////needs tested.

        }

        $n = count(self::$optionsarray);

        for ($i = 0; $i < $n; $i++) { 

            $this->obj = new \cmu\html\form\products\Input;
            //below will check for value and set CHECKED
            $this->changeProperty('replace', 'value', array_values(self::$optionsarray)[$i]);

            $this->changeProperty('replace', 'caption', array_values(self::$optionsarray)[$i]);
            //set checked if value matches
            if (isset(self::$valuesarray)) {
                //if the value='value' is in the array of values pulled from DB, it should be checked
                if (array_values(self::$optionsarray)[$i] ==  array_values(self::$valuesarray)[0] ) {

                    $this->changeProperty('replace', 'checked', 'checked');  //only ONE value is permissable with radio controls, must be the first one!
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

