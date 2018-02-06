<?php
namespace cmu\html\form\builders;

class CompositeTextareaBuilder extends AbstractCompositeBuilder

{

    public function make()

    {

        ////LABEL///////////////////////////////////////////////
        $labeloverrrides = array (      array('replace', 'label', 'textareaoverride') 

                                 );
        
        $this->addBuilder(new \cmu\html\form\builders\VariableLeafBuilder("Label", $labeloverrrides));

        



        /////Textarea//////////////////////////////////////////////////////
                                    //TEXT is the name of the value
        $textareaoverrrides = array (   array('replace', 'cols', '22'),
                                            
                                        array('replace', 'rows', '3'),
                
                                        array('replace', 'appendname', "[]")

                                    );
        
        $this->addBuilder(new \cmu\html\form\builders\LeafTextareaBuilder($textareaoverrrides));

    }

}