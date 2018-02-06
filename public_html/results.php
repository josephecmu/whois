<?php 

    //Global include file
    include_once '../code/class/cmu/config/site/whois.conf';
    //get the $_POST or $_GET arrays and convert to variables function
    include_once '../code/class/cmu/config/site/variables_from_array.inc';
    //use correct include file (based on search results)
    include '../code/class/cmu/config/site/table.conf';

    
    (new \cmu\html\controller\TableController())->process();

    
