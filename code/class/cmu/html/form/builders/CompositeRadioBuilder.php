<?php
namespace cmu\html\form\builders;

class CompositeRadioBuilder extends AbstractCompositeBuilder

{

    public function make()

    {
        ////LABEL///////////////////////////////////////////////
        
        $labeloverrrides = array (  array('replace', 'label', 'labelfromoverrride'),



                                    );
        
        $this->addBuilder(new \cmu\html\form\builders\VariableLeafBuilder("Label", $labeloverrrides) );


        /////CHECKBOX//////////////////////////////////////////////////////
                                        //probably handled by metaarray
        $radiooverrrides = array (   array('replace', 'type', 'radio'),

                                        //array('replace', 'value', array_values(self::$optionsarray)[$i]),

                                        array('replace', 'appendname', "[]")

                                    );
        
        $this->addBuilder(new \cmu\html\form\builders\LeafRadioBuilder ($radiooverrrides));

    }

}