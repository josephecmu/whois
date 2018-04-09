<?php 

    //Global include file
    include_once '../code/class/cmu/config/site/whois.conf';
    //use correct include file (based on search results)
    include '../code/class/cmu/config/site/table.conf';

    
    (new \cmu\html\controller\TableController())->process();

    
