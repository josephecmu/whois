<?php

    include'../code/class/cmu/config/site/people.conf';

    $ldap_parms = ['att' => array_keys($person_array), 
                'filter' => "(objectClass=*)"];                             //'dn' => set internally 

    $meta = (new \cmu\html\base\Meta());                                    //instantiate new META to hold array

    $meta->setProperties($person_array);                                    //assign meta array to META object

    $dic = new \cmu\html\form\SingMetaQueryDic($meta, $ldap_parms);         //build Depandency Injection Container

    $control = $dic->returnDisplayObject();                                 //returns new instance of FormClient()

    $control->buildForm();                                                  //final COMPOSITE objects

    if ($control->validateForm()) {                                         //if validate, process and return errors

        if ($control->checkChangeForm()) {                 //see if the form has changed before we go any further!!
    
            try {

                $control->processForm();
                
                $this->forward( '../code/class/cmu/html/view/success.php' );
            
            } catch ( \Exception $e ) {

                $this->forward( '../code/class/cmu/html/view/error.php' );

            }

        } 

    } 

    echo $control->returnDisplay(); 
