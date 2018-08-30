<?php
namespace cmu\html\general\products;

class Div extends AbstractGeneralComponent
//DIV
{

    private $divdata;


    public function setDivdata($divdata_in)

    {

        $this->divdata = $divdata_in;

    }

    public function getDivData()

    {

        if (isset($this->obj)) {

          return $this->returnObject();

        }

		return $this->divdata;

    }

}
