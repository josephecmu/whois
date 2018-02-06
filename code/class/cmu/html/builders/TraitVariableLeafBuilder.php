<?php
namespace cmu\html\builders;

trait TraitVariableLeafBuilder

{

    private $class;

    function returnSimpleLeaf($class)

    {
        
        $namespace = ((new \ReflectionObject($this))->getNamespaceName());

        $ulevel_nspace = substr($namespace, 0, strrpos($namespace, '\\'));

        $prod_namespace = $ulevel_nspace . '\products';

        $prod_class = $prod_namespace . "\\" . $class;

        $this->obj = new $prod_class;

        $this->arrayChangeProperty();
    
        $this->setProperty();

        return $this->obj;

    }

}