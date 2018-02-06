<?php 
namespace cmu\html\form\products;

class Input extends AbstractControls
    
{

    use TraitTextValidate, TraitDisabled, TraitPlaceholder, TraitAutofocus, TraitValue, TraitType;

    private $checked;
    //private $required; //required attribute, will try with custom required code
    private $list;   //for datalist
    private $caption; //for checkboxes and radio labels
    private $checkedvalue; //this the set via the builder so we can easily access the value set

    function setChecked($checked_in)

    {

        if (isset($checked_in)) {

            $this->checked = "checked";
        
        }

    }

    function setCheckedvalue($checkedvalue_in)

    {

            $this->checkedvalue = $checkedvalue_in;

    }

    function setList($list_in)

    {

        $this->list = $list_in;

    }

    function setRequired($required_in)

    {
        if (isset($required_in)) {

            $this->required = "required";
        }

    }

    function setCaption( string $caption_in)

    {

        $this->caption = $caption_in;

    }

    public function getCaption()

    {

        if (isset($this->caption)) { 
        
            return "<span>" . $this->caption . "</span>";

        }

    }

    public function getChecked()

    {

        return $this->checked;
    
    }

    public function getCheckedValue()

    {

        return $this->checkedvalue;
    
    }

    protected function getHtmlList()

    {

        if (isset($this->list)) { 
        
            return  "list = '" . $this->list . "'";

        }

    }

    protected function getHtmlChecked()

    {

        if (isset($this->checked)) { 
        
            return $this->checked;

        }

    }

}


