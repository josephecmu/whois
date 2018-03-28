<?php 
namespace cmu\html\base;

class LdapValues extends AbstractValues 

{
	//this might work better from Mapper ???
    private function returnLdapNormValuesArray (array $array)   : array                 //could be recursive function

    {

        $do_ldap = array();

        foreach($array as $k => $v) {

            if (!is_int($k)) {                                                      //only iterate over strings
    
                if ($k == "dn") {                                                   //move 'dn' values to array

                    $values_ldap[$k] = array($v);

                    continue;

                }

                if ($k == 'count') {	                            				//dont add [count]

                    continue;                                                      

                } 

                $values_ldap[$k] = $v;                                              //add to $values_ldap

                if (is_array($v) && key_exists('count', $v)) {					    //remove count and leave value

                    unset($values_ldap[$k]['count']);

                }

            }

        }

        return $values_ldap;

    }

    public function getCheckValue($key)                  //return array, not null, used below

    {

        if (null == $this->values) {

            return array();

        }

        return $this->getValue($key);

    }

    function returnSingleLdapNormValuesArray() : array

    {

        return $this->returnLdapNormValuesArray($this->getCheckValue(0));      //return single array

    }

    function returnMultiLdapNormValuesArray()

    {

        $count = $this->values["count"];

        for ($i=1; $i<$count; $i++) {  

            $norm_values_array[] =  $this->returnLdapNormValuesArray($this->getCheckValue($i));		//call method above and assign to another array for iteration of multiple records

        }

        return $norm_values_array;

    }

}
