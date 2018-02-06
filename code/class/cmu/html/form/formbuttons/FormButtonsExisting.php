<?php
namespace cmu\html\form\formbuttons;

class FormButtonsExisting extends AbstractFormButtons 

{

    function addToForm()

    {

        if (null !== $this->formclient->getRequestObject()->getValue('dn')) {     //editing  DN is passed in GET and POST
            //UPDATE
            $this->createButton('Update');
            //DELETE
            $this->createButton('Delete');
        } else {                                        //blank form
            //ADD
            $this->createButton('Add');
        }

    }

}