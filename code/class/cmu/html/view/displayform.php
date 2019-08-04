<?php

	$dic = new \cmu\html\form\SingMetaQueryDic(); 

    $control = $dic->returnDisplayObject();                                 //returns new instance of FormClient()

    $control->buildForm();                                                  //final COMPOSITE objects

    if ($control->validateForm()) {                                         //if validate, process and return errors

        if ($control->checkChangeForm()) {                 //see if the form has changed before we go any further!!
  
  			try {

            $control->processForm();
            
//              $this->forward( '../code/class/cmu/html/view/success.php' );
//				$this->forward ( 'results.php' );
//				header ('Location: http://whois.math.cmu.edu');				

      		} catch ( \Exception $e ) {
		   		$this->forward( '../code/class/cmu/html/view/error.php' );

		 }

      } 

    } 

    echo $control->returnDisplay(); 
