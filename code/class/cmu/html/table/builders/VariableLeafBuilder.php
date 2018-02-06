<?php
namespace cmu\html\table\builders;

class VariableLeafBuilder extends AbstractLeafBuilder

{

    use \cmu\html\builders\TraitVariableLeafBuilder;

    function __construct($class_in, array $overrides_in = null)

    {

        parent::__construct($overrides_in);

        $this->class = $class_in;

    }

    function returnLeaf()

    {

        return $this->returnSimpleLeaf($this->class);

    }

}