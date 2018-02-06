<?php
namespace cmu\html\builders;

trait TraitVariableSingleBuilder

{

    private $class;

	public function makeSimple($class)

    {

        $namespace = ((new \ReflectionObject($this))->getNamespaceName());

        $variable_leaf_class =  $namespace . "\\VariableLeafBuilder";

        $this->addBuilder(new $variable_leaf_class($class));
    
	}

}