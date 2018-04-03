<?php

namespace cmu\html\form\formbuttons;

use \cmu\html\products\AbstractHtmlDisplayClient;

class FormButtonsContext

{

    function process(AbstractHtmlDisplayClient $formclient)          //BUTTONS

    {

        $ucasestate = ucfirst($formclient->getState());

        $class = "\\cmu\\html\\form\\formbuttons\\FormButtons" .  $ucasestate;

        (new $class($formclient))->addToForm();

    }

}
