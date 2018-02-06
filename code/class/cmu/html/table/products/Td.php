<?php
namespace cmu\html\table\products;

class Td extends AbstractTableComponent
//TD
{

    use TraitColspan, TraitHeaders, TraitRowspan, \cmu\html\products\TraitExternalArray;

    private $tddata;             //<td> content
    private $objarray = null;    //external attributes and object
    private $objstring = null;  

    public function setObjstring( string $objstring_in)

    {

        $this->objstring = $objstring_in;

    }

    public function setTddata($tddata_in)

    {

        $this->tddata = $tddata_in;

    }

    public function getTddata()

    {

        return $this->tddata;

    }

    public function setObjarray(array $objarray_in)

    {

        $this->objarray = $objarray_in;

    }

    public function setObj($obj_in)

    {
 
        $this->obj = $obj_in;

    }

    public function returnTddata()

    {
     
        if (isset($this->objarray)) {  //we are using external object for TDDATA

            return $this->returnExternalObjectHtml($this->objarray['obj'], $this->objarray['att']);  //method in \cmu\html\products\AbstractProduct

        } else {
   
            return $this->tddata;

        }

    }

}