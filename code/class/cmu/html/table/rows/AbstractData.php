<?php
namespace cmu\html\table\rows;

abstract class AbstractData extends AbstractRow

{

    private function convertArrayStringWithSeperator(array $array, $seperator = "<br />")              //any more modifyers, we should consider command pattern

    {
      
        $count = count($array);                                         //count elements

        if ($count == 1 ) {                                           

            return $array[0];                                           //just return the string
        
        } else {

            return implode($seperator, $array);             //"<br />"  //otherwise, more than one element, implode with <br />s

        }

    }

    function arrayValueToString($key)

    {

        foreach ($this->row as $k => $v) {                                       

            if (isset ($v[$key]) && is_array($v[$key])) {			//we are converting arrays to strings.

                $string = $this->convertArrayStringWithSeperator($v[$key], "<br />");     //convert tddata ARRAY to STRING / IMPLODE

                unset($v[$key]);

                $this->row[$k][$key]  = $string;

            }

        }

    }

}