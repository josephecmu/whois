<?php 
namespace cmu\html\builders;

trait TraitLeafBuilder

{

    protected $obj;
    //array containing all the metadata 
    protected $overrides = array();

    abstract function returnLeaf();
    //this method could be converted to STRATEGY PATTERN if much bigger?
    protected function changeProperty($action, $key, $value1, $value2 = null)

    {
        
        //check if key exists
        if (!property_exists($this->obj, $key)) {
            
            echo "Object does not exist... $key";
            return;
            
        } else {

           // if (!isset( self::$elementarray[$key])) {  return; }
            switch ($action) {

                case "append":

                    $replace_value = self::$elementarray[$key] . " " . $value1 . " " . $value2;         //keep the current value and add others

                break;

                case "replace":

                    if (is_array($value1)) {

                        self::$elementarray[$key] = $value1;

                        return;

                    } else {

                        $replace_value = $value1 . $value2;

                    }

                break;

                case "replaceifset":

                    if (is_array($value1)) {

                        self::$elementarray[$key] = $value1;

                        return;

                    } elseif(isset($value1)) {

                        $replace_value = $value1 . $value2;

                    } else {

                        return;

                    }

                break;

                default:
                    
                    echo "incorrect action specified";

            }

        }
            
            self::$elementarray[$key] =  $replace_value;                               //assign to array key

    }
    
    protected function arrayChangeProperty()   //calls function above, iterate through [object]OVERRRIDES making changes
    
    {
        
        if (!empty($this->overrides)) {
    
            foreach ($this->overrides as $value) {

				$value[3] = $value[3] ?? null ;

                $this->changeProperty($value[0], $value[1], $value[2], $value[3]);

            }

        }
    
    }
    //call dynamic setter in classes
    protected function setProperty()

    {

        $this->obj->setThisProperty(self::$elementarray);
        //reset elementarray
        self::$elementarray = self::$metaarray;

    }

}
