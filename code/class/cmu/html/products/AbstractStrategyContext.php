<?php
namespace cmu\html\products;

abstract class AbstractStrategyContext

{

    protected $strategies = array();  //the strategies are passed via comma seperated string (srtat1,strat2) then converted to array iterated

    public function __construct($strategies_in) 
    
    {

        if (strstr($strategies_in, ",") == true) { ////we have a comma seperataed string
           
            $this->strategies = explode(",", $strategies_in);  //convert CSV to array

        } else {

            $this->strategies[] = $strategies_in; //no CSV, only one element

        }

    }

}