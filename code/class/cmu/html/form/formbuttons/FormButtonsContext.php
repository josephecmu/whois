<?php
namespace cmu\html\form\formbuttons;

class FormButtonsContext

{

    function process(\cmu\html\products\AbstractHtmlDisplayClient $formclient)          //BUTTONS

    {

        $ucasestate = ucfirst($formclient->getState());

        $class = "\\cmu\\html\\form\\formbuttons\\FormButtons" .  $ucasestate;

        (new $class($formclient))->addToForm();

    }

}