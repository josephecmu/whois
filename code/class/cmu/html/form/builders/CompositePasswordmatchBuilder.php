<?php 
namespace cmu\html\form\builders;

class CompositePasswordmatchBuilder extends AbstractCompositeBuilder

{
    //BUILDER designed to create a second password box and div to print out error message.
    //the first textbox handles the user input and gets passed via POST, the second box is set to 'NOPOST'
    public function make()

    {

        //$labeloverrrides = array (  array('replace', 'class', 'newtest'),

                                    //array('append', 'alt' , 'alttest_labelclass') 
                                     
                                 //);
        
        $this->addBuilder(new VariableLeafBuilder("Label"));


        $pass2overrrides = array(   

                                    array ('replace', 'id', 'txtConfirmPassword'),

                                    array ('replace', 'onchange', 'checkPasswordMatch()'),

                                    array ('replace', 'type', 'password'),

                                    array('replace', 'appendname', "[]")
    
                                     
                                );
        //we can use a variable builder here because the values are not re-populated
        $this->addBuilder( new LeafTextBuilder($pass2overrrides));


        $divoverrrides = array(   

                                  array ('replace', 'id', 'divCheckPasswordMatch'),
                                     
                                );

        $this->addBuilder( new VariableLeafBuilder('Div', $divoverrrides));
        
    }

}