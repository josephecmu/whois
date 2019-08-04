<?php 
namespace cmu\html\form\products;

trait TraitOption

{
    //attributes
    private $optionsarray = array();
    private $keyoption = null;  //show KEY for value instead of VALUE 
    //set key option to 'KEY" above so KEY is displayed instead of VALUE
    function setKeyoption($key_in) : void
    {
        $this->keyoption = $key_in;
    }

    function setOptionsarray(array $optionsarray_in) : void
    {
        $this->optionsarray = $optionsarray_in;
    }

    function getOptionsArray() : array
    {
        return $this->optionsarray;
    }
    //allow the concrete classes to impliment if selected="selected" is used.
    abstract function selectHook();

    function buildTraitOptions() : string
    {
        foreach($this->optionsarray as $k => $v) {

            $value = $this->keyoption == 'key' ? $k : $v ;  //set the VALUE attribure to the KEY or VALUE of options array based on $keyoption property
            $options_array[] = $this->selectHook($value, $v);  //add to array
        }
        $options_html = implode(' ', $options_array);  //implode the array, creating all the HTML with <options>.
        return $options_html;
    }
}
