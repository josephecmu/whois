<?php
namespace cmu\html\form\builders;

use cmu\html\form\builders\VariableLeafBuilder;
use cmu\html\form\builders\LeafTextBuilder;

class CompositeTextboxgrouparraydeleteBuilder extends AbstractCompositeBuilder

{

    public function make()

    {

        $labeloverrrides = array (  array('append', 'class', 'newtest'),

                                    array('append', 'alt' , 'alttest_labelclass'),

                                    array ('replace', 'id' , 'newid')
                                     
                                 );
        
	
		$this->addBuilder(new VariableLeafBuilder("Label", $labeloverrrides));

		$textoverrrides =   [   
											
				
							  //      ['replace', 'appendname', '[' . $i . ']' ]
									 
						];
		//loop through the number of values
		//replace outlets[x] iteration 
		//iterate, changing the passed iteration
		$this->addBuilder( new LeafTextGroupDeleteBuilder($textoverrrides));

		}


}
