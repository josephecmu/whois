<?php
namespace cmu\html\products\property;

class SetPropertyExternalarray extends AbstractSetProperty

{

	private $keyarray = array();

    public function returnValue()

    {
        
        $pattern = "/%%#((.*)*)#%%/U";                                  //%%#KEY#%%
       
        preg_match_all($pattern, $this->value, $matches);               //build our array of matches

        $ele = count($matches[0]);

        for($i=0; $i<$ele; $i++) {

            $this->keyarray = explode(",", $matches[1][$i]);

            $replacement = $this->arraySearch($this->obj->getExternalArray());
    
            $single_pattern = "/" . $matches[0][$i]. "/";

            $this->value = preg_replace($single_pattern, $replacement, $this->value);

        }

        return $this->value;

    }
    
    private function arraySearch(array $array)                          //recursive method to find final value from array of keys

    {

        $last_key = key(array_slice( $this->keyarray, -1, 1, TRUE ));

        static $i = 0;

        foreach($array as $k => $v) {

            if ($k === $this->keyarray[$i]) {

                if ($i === $last_key) {                                 //BASE CASE

					$i = 0;

                    return $v;                                          //break the loop and return

                }

				$i++;

				$result = $this->arraySearch($v);
 
				if ($result != false) {

					return $result;

				}

            }

        }

		return false;

    }

}