<?php
namespace cmu\html\form\sanitize;

class SanitizeContext extends \cmu\html\products\AbstractStrategyContext

{
    public function sanitizeText($valuetovalidate_in)

    {

        $tempvalue = $valuetovalidate_in;

        foreach($this->strategies as $strategy) {
            ////convert to uppercase first letter and after each '_' to get CLassName
            $ucase_strategy = str_replace(' ', '',  ucwords(str_replace('_', ' ', $strategy)));

            $class_name = 'cmu\html\form\sanitize\Sanitize' . $ucase_strategy; 

            $this->strategy = new $class_name($tempvalue);

            $tempvalue = $this->strategy->sanitizeInput();  //change $tempvalue and re-submit to array

        }

        return $tempvalue;   //after all modification on value is done, return it.

    }

}