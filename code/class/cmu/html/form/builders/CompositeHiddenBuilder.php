<?php
namespace cmu\html\form\builders;

class CompositeHiddenBuilder extends AbstractCompositeBuilder

{

    public function make()

    {
        $hiddenoverrrides = array();

        //if (isset(self::$elementarray['values'])) {

             $hiddenoverrrides[] = ['replaceifset', 'value', self::$elementarray['values'][0]];

        //}

        $this->addBuilder(new VariableLeafBuilder("Input", $hiddenoverrrides));

    }

}