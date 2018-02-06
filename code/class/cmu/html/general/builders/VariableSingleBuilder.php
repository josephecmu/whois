<?php
namespace cmu\html\general\builders;

class VariableSingleBuilder extends AbstractCompositeBuilder

{
    
    use \cmu\html\builders\TraitVariableSingleBuilder;

    function __construct( string $class_in, array $metaarray_in)

    {
            
        parent::__construct($metaarray_in);

        $this->class = $class_in;

    }

    function make()

    {

        $this->makeSimple($this->class);

    }

}