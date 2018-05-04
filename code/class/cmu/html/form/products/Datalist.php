<?php 
namespace cmu\html\form\products;

class Datalist extends AbstractFormComponent

{

    use TraitOption;
    //Datalist does not select anything, only provides lookups
    private function selectHook(string $value, string $v) : string //function is not used??

    {

        $options_string = "<option value='$value'>$v</option>";

        return $options_string;

    }

}