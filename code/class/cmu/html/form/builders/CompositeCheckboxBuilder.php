<?php
namespace cmu\html\form\builders;

class CompositeCheckboxBuilder extends AbstractCompositeBuilder

{

    public function make()

    {
        //Fieldset////////////////////////////////////
        $fieldsetoverrrides = array (  

                                    );
        
<<<<<<< HEAD
        $fieldset = $this->addBuilder(new VariableLeafBuilder("Fieldset"));
=======
        $this->addBuilder(new \cmu\html\form\builders\VariableLeafBuilder("Fieldset"));
>>>>>>> joe
        

        ///////////LEGEND///////////////////////////
        $legendoverrides = array    ( //array('replace', 'legendname', 'Some Legend Name')

                                    );
        
        $legend = $this->addBuilder( new VariableLeafBuilder("Legend", $legendoverrides) );

        ////LABEL///////////////////////////////////////////////
        $labeloverrrides = array    (  array('replace', 'label', 'checkboxoverride') 

                                    );
        
        $this->addBuilder(new VariableLeafBuilder ("Label", $labeloverrrides) );


        /////CHECKBOX//////////////////////////////////////////////////////
        $checkboxoverrrides = array (   array('replace', 'type', 'checkbox'),

                                        //array('replace', 'value', array_values(self::$optionsarray)[$i]),

                                        array('replace', 'appendname', "[]")

                                    );

        $this->addBuilder(new LeafCheckboxBuilder ($checkboxoverrrides) );

        $closefieldsetoverrrides = array( array('replace', 'tag', 'SOMETHING'));

        $this->addBuilder( new VariableLeafBuilder("CloseTag", $closefieldsetoverrrides));

        

    }

}
