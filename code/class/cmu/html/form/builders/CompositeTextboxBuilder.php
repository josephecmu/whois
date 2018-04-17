<?php
namespace cmu\html\form\builders;

class CompositeTextboxBuilder extends AbstractCompositeBuilder

{

    public function make()

    {

        $labeloverrrides = array (  array('append', 'class', 'newtest'),

                                    array('append', 'alt' , 'alttest_labelclass'),

                                    array ('replace', 'id' , 'newid')
                                     
                                 );
        
        $this->addBuilder(new VariableLeafBuilder("Label", $labeloverrrides));

        $textoverrrides = array(); 

        if (isset(self::$valuesarray)) { //only print values if values array exists

             $textoverrrides[] = array ('replace', 'value',  self::$elementarray['values'][0]);         //only one value, map to VALUE   

        }

        $this->addBuilder( new VariableLeafBuilder("Input", $textoverrrides));

    }

}