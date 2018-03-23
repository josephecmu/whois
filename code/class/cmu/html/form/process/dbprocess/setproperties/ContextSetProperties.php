<?php
namespace cmu\html\form\process\dbprocess\setproperties;

class ContextSetProperties
{

    private $strategy;

    function __construct($ou)

    {

        $ouonly = substr($ou, 3 );                                                       //strip "ou=" from $ou

        $this->strategy = ucfirst($ouonly) . "SetProperties";

    }

    function returnProperty(string $property)

    {

        $class = "\\cmu\\html\\form\\process\\dbprocess\\setproperties\\" . $this->strategy;

        $strat = new $class;

        return $strat->getProperty($property);

    }

}
