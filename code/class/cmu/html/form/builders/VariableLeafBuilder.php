<?php
namespace cmu\html\form\builders;

class VariableLeafBuilder extends AbstractLeafBuilder

{

    use \cmu\html\builders\TraitVariableLeafBuilder;

    function __construct(string $class_in, array $overrides_in = null)

    {

        parent::__construct($overrides_in);

        $this->class = $class_in;

    }

    function returnLeaf()

    {

       return $this->returnSimpleLeaf($this->class);

    }

}