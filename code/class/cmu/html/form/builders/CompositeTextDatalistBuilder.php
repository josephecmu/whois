<?php
namespace cmu\html\form\builders;

class CompositeTextDatalistBuilder extends AbstractCompositeBuilder

{

    public function make()

    {
        //Label///////////////////////////////////////
        $labeloverrrides = array (  //array('replace', 'label', 'datalist'),

//                                    array('append', 'alt' , 'alttest_labelclass') 
                                     
                                 );

        $this->addBuilder(new \cmu\html\form\builders\VariableLeafBuilder("Label", $labeloverrrides) ); //////////shorter version  of above 2 lines using makeAndAddElement()


        //TextBox/////////////////////////////////////////
        $textoverrides = array ( array('replace', 'list' , 'lookup'), 

                                    array('replace', 'class' , 'lookup'),

//                                array('replace', 'appendname', "[]")

                                );

        $this->addBuilder(new \cmu\html\form\builders\LeafTextBuilder($textoverrides));

        //DATALIST/////////////////////////
        $datalistoverrrides = array (  //array('replace', 'optionsarray', self::$optionsarray),

                                        array('replace', 'id', 'lookup'),

 //                               array('replace', 'appendname', "[]")
                                     
                                 );

        $this->addBuilder( new \cmu\html\form\builders\VariableLeafBuilder("Datalist", $datalistoverrrides) );

    }

}
