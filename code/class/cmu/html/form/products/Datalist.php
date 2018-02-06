<?php 
namespace cmu\html\form\products;

class Datalist extends AbstractFormComponent

{

    use TraitOption;
    //Datalist does not select anything, only provides lookups
    private function selectHook($value, $v)

    {

        $options_string = "<option value='$value'>$v</option>";

        return $options_string;

    }

}