<?php

    //INCLUDES//////////////////////////////////
    //Global include file
    include_once '../code/class/cmu/config/site/whois.conf';
    //get the $_POST or $_GET arrays and convert to variables function
    include_once '../code/class/cmu/config/site/variables_from_array.inc';

    include_once '../code/class/cmu/config/site/people.conf';

    
    //kickstart the controller
    (new \cmu\html\controller\FormController())->process();