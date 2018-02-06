<?php
namespace cmu\html\form\builders;

class CompositeTextboxarrayBuilder extends AbstractCompositeBuilder

{

    public function make()

    {

        $labeloverrrides = array (  array('append', 'class', 'newtest'),

                                    array('append', 'alt' , 'alttest_labelclass'),

                                    array ('replace', 'id' , 'newid')
                                     
                                 );
        
        $this->addBuilder(new \cmu\html\form\builders\VariableLeafBuilder("Label", $labeloverrrides));

        $textoverrrides =   [   

                                    ['replace', 'appendname', "[]"]
                                     
                            ];

        $this->addBuilder( new \cmu\html\form\builders\LeafTextBuilder($textoverrrides));

    }

}