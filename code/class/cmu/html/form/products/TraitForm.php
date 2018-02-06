<?php 
namespace cmu\html\form\products;

trait TraitForm

{

 private $form;    
    //setters
    public function setForm($form_in)

    {

        $this->form = $form_in;

    }

    protected function getHtmlForm()

    {

        if (isset($this->form)) { 
        
            return  "form = '" . $this->form . "'";

        }

    }

}