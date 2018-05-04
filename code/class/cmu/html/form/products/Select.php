<?php
namespace cmu\html\form\products;

class Select extends AbstractControls

{
    //include traits
    use TraitOption, TraitDisabled;
  
    //value of selected option
    private $selectedvalue = null;

    public function setSelectedvalue($selected_in)

    {

        $this->selectedvalue = $selected_in;

    }

    public function getSelectedvalue()

    {

        return $this->selectedvalue;

    }
    
    //concrete class implimentation to create a 'selected' drop down
    private function selectHook(string $value, string $v) : string

    {
    	//shortahand for $selected value
        $selected = ($value == $this->selectedvalue) ? "selected = 'selected'" : null ;

        $options_string = "<option $selected value='$value'>$v</option>";
        
        return $options_string;
        
    }

}