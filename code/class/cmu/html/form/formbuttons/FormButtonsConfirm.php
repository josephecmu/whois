<?php
namespace cmu\html\form\formbuttons;

class FormButtonsConfirm extends AbstractFormButtons 

{

    function addToForm()

    {

        $this->formclient->getDisplay()->setHintmessage('Please Confirm and sumbit below.');
               
        if ($this->formclient->getRequestObject()->getValue('action') == 'Delete') { //confirm
            
            $this->createButton('Confirm Delete'); //DELETE
    
        }

    }

}