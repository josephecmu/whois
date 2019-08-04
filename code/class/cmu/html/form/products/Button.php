<?php 
namespace cmu\html\form\products;

class Button extends AbstractControls
    
{
    use TraitDisabled, TraitForm, TraitAutofocus, TraitValue, TraitType, TraitActions;

    private $formaction;
    private $formtarget;
    private $formmethod;
    private $formnovalidate;

    public function setFormaction( string $formaction_in)

    {

        if (isset($formaction_in)) {

           $this->formaction = $formaction_in;

        }
        
    }

    public function setFormtarget( string $formtarget_in)

    {

        if (isset($formtarget_in)) {

            $this->formtarget = $formtarget_in;

        }

    }

    public function setFormmethod( string $formmethod_in)

    {

        if (isset($formmethod_in)) {

            $this->formmethod = $formmethod_in;

        }

    }

    public function setFormnovalidate( int $formnovalidate_in)

    {

         if (isset($formnovalidate_in)) {

            $this->formnovalidate = $formnovalidate_in;

        }

    }

    protected function getHtmlFormaction()

    {

         if (isset($this->formaction)) { 
        
            return  "formaction = '" . $this->formaction . "'";

        }

    }

    protected function getHtmlFormtarget()

    {

         if (isset($this->formtarget)) { 
        
            return  "formtarget = '" . $this->formtarget . "'";

        }

    }

    protected function getHtmlFormmethod()

    {

         if (isset($this->formmethod)) { 
        
            return  "formmethod = '" . $this->formmethod . "'";

        }

    }

    protected function getHtmlFormnovalidate()

    {

         if (isset($this->formnovalidate)) { 
        
            return  "formnovalidate = '" . $this->formnovalidate . "'";

        }

    }
    
}
