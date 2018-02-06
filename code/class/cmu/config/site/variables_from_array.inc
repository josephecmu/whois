<?php

        //grab our POST input, dynamically set values / $variables
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                foreach ($_POST as $k => $v ) {

                        if (!is_array($v)) {

                            $$k = $v;

                            //let's get our column/value array WITHOUT administrative array
                            if ($k != "action") {

                            $pair[$k] = trim($v);

                        }

                       } elseif ($k != 'assigned') { // we have an array of values NOT assigned (for assignments))
                            //assuming we have a SET datatype, take the array, convert to string and insert it into the $pair array.                                
                            $imploded_values = implode(",", $v);
  
                            $pair[$k] = $imploded_values;   
 
                       }
 
               }
         
         }      
         //grab our GET input, dynamically set values / $variables
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 
               foreach ($_GET as $k => $v ) {

                    $$k = $v;
                       //let's get our column/value array WITHOUT administrative array
                       if ($k != "action") {

                          $pair[$k] = trim($v);

                       }
 
               }
  
       }      
                
?>