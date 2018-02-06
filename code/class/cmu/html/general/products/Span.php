<?php 
namespace cmu\html\general\products;

class Span extends AbstractGeneralComponent
//SPAN
{

    private $spandata;

    public function setSpandata($spandata_in)

    {

        $this->spandata = $spandata_in;

    }

    public function getSpanData()

    {

        if (isset($this->obj)) {

            return $this->returnObject();

        } else {

            return $this->spandata;

        }

    }

}