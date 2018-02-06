<?php
namespace cmu\html\form\builders;

class CompositeSelectBuilder extends AbstractCompositeBuilder

{

    public function make()

    {
        ////LABEL///////////////////////////////////////////////
        $labeloverrrides = array (  array('replace', 'label', 'selectoverride') 

                                 );
        
        $this->addBuilder(new \cmu\html\form\builders\VariableLeafBuilder ("Label", $labeloverrrides));


        /////SELECT//////////////////////////////////////////////////////
        $selectoverrrides = array ( //array('replace','name', 'overname'),

                                    //array('replace','selectedvalue', array_values(self::$valuesarray)[0]) //we should only have one value here, only 1 can be selected.
    
                                    array('replace', 'appendname', "[]")

                                  );
        
         //echo key(self::$elementarray);


        $this->addBuilder(new \cmu\html\form\builders\LeafSelectBuilder($selectoverrrides));

    }

}