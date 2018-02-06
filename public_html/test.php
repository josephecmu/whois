<html>
<head>
    <title>Test Page</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="script.js"></script>
        
</head>


<?php

    //Global include file
    include_once '../code/whois.conf';
    //get the $_POST or $_GET arrays and convert to variables function
    include_once '../code/variables_from_array.inc';

    include_once '../code/people.conf';
                                              

    if (!isset($_POST)) { 

        $_POST = null; 

    }

    if(isset($_POST)) {
        //INJECT [value]
        foreach ($_POST as $k => $values) {

            if ($k != 'action') {             //or check to make sure only keys in array

                $person_array[$k]['values'] = $values;

            }

        }  

    }

    $controls = new \cmu\html\form\FormClient($person_array, $_POST);

    $controls->buildDisplay();

    echo $controls->returnDisplay();

?>


    <body>




</html>
