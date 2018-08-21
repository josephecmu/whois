<?php
namespace cmu\html\products\property;

class SetPropertyRowregistry extends AbstractSetProperty

{

//probably delete, failed REGISTRY attempt, would still nees to add 'flag' property linking row key with correct dataset

	private $keyarray = array();

    public function returnValue()

    {
    
        $rowregistry =  \cmu\html\base\registry\TableRowRegistry::getTableRow();
        //%%#KEY#%%
        $pattern = "/%%#((.*)*)#%%/U";
        //build our array of matches
        preg_match_all($pattern, $this->value, $matches);

        $ele = count($matches[0]);

        for($i=0; $i<$ele; $i++) {

            $this->keyarray = explode(",", $matches[1][$i]);

            //$replacement = $this->arraySearch($this->obj->getExternalArray());
            //echo $replacement;

 
            //print_r($this->obj->getExternalArray());

            //echo "<br />  rowregistry";
            $replacement = $this->arraySearch($rowregistry->getProperties());

            //echo $replacement;


            $single_pattern = "/" . $matches[0][$i]. "/";

            $this->value = preg_replace($single_pattern, $replacement, $this->value);

        }

        return $this->value;

    }
    
    private function arraySearch(array $array)  //recursive method to find final value from array of keys

    {

        $last_key = key(array_slice( $this->keyarray, -1, 1, TRUE ));

        static $i = 0;

        foreach($array as $k => $v) {

            if ($k === $this->keyarray[$i]) {

                if ($i === $last_key) {

					$i = 0;

                    return $v;  //break the loop and return

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
