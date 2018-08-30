<?php
namespace cmu\html\form\builders;

use cmu\html\form\builders\VariableLeafBuilder;
use cmu\html\form\builders\LeafTextBuilder;
use cmu\html\general\builders\VariableLeafBuilder as VariableLeafBuilderGeneral;

class CompositeTextboxgrouparraydeleteBuilder extends AbstractCompositeBuilder

{

    public function make()

    {

        $labeloverrrides = [];
		$this->addBuilder(new VariableLeafBuilder("Label", $labeloverrrides));

		$textoverrrides = [
		
							        ['append', 'class', 'sub' ]
		
		];
		
		$divoverrrides = [ 
					
							['replace', 'class', 'test'],
		
		];

		
        $fieldsetoverrrides = array (  

                                    );
        
		$this->addBuilder(new \cmu\html\form\builders\VariableLeafBuilder("Fieldset"));

		$this->addBuilder( new LeafTextGroupDeleteBuilder($textoverrrides));

		
        $closefieldsetoverrrides = [];
        $this->addBuilder( new \cmu\html\form\builders\VariableLeafBuilder("CloseTag", $closefieldsetoverrrides));




		}


}
