<?php 
namespace cmu\html\products;

trait TraitExternalArray

{

    private $externalarray = [];

    public function getExternalArray()

    {

        return $this->externalarray;

    }

    public function setExternalarray(array $externalarray_in)

    {

        $this->externalarray = $externalarray_in;

    }

}