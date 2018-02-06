<?php 
namespace cmu\html\form\products;

class CompositeControl extends AbstractComposite

{

    private $reqnumber = 0;         //how many are required per composite
    private $countset = 0;          //internal counter to keep track of set fields

    public function setReqnumber ( int $reqnumber_in)

    {

        $this->reqnumber = $reqnumber_in;

    }

    public function setCount()

    {
        
        $this->countset++;

    }

    public function getCountSet()

    {

        return $this->countset;

    }
    //override parent implimentation, then call parent
    function returnErrorMessage()
    
    {
    
        if ($this->reqnumber == 1) { //only one field is required

            $this->setErrormessage("Required");

        } elseif ($this->reqnumber > 1) {

            $this->setErrormessage("At least" . $this->reqnumber . "must be selected.");   //more that 1 at least X must be selected

        }

        return parent::returnErrorMessage();
    
    }
    //concrete implimentation to retrunHtml from AbstractComposite class.  It sets the html surrounding the composite and returns stuff inside
    function getTag()

    {

        return "div";

    }


    public function getReqnumber()

    {

        return $this->reqnumber;

    }

}