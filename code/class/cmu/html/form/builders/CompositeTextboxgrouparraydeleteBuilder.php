<?php
namespace cmu\html\form\builders;

use cmu\html\form\builders\VariableLeafBuilder;
use cmu\html\form\builders\LeafTextBuilder;

class CompositeTextboxgrouparraydeleteBuilder extends AbstractCompositeBuilder

{

    public function make()

    {

 		$numberofvaluesarray = (isset(self::$valuesarray[0])) ? count(self::$valuesarray) + 1 : 1 ;

		for ($counter = 0; $counter < $numberofvaluesarray; $counter++) {//iteration of values array(i.e. # of outlets) 

			$textoverrrides = [];
			$labeloverrides = [ [ 'append', 'label', $counter ] ];

			$this->addBuilder( new VariableLeafBuilder("Label", $labeloverrides ));
			$this->addBuilder( new LeafTextGroupDeleteBuilder($textoverrrides, $counter));

		}

	}

}
