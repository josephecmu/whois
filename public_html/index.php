<html>
    <title>test</title>
    <head>
        <style>
        table, th, td   {
                            border: 1px solid black;
                        }
        </style>

    </head>

<body>

<h1>Test Builder</h1>




<?php
    //Aliases
    use \cmu\html\table\builders\SingleTdBuilder as SingleTdBuilder;
    use \cmu\html\table\builders\SingleTrBuilder as SingleTrBuilder;
    use \cmu\process\ldap\LdapProcessorContext   as LdapProcessorContext;
    use \cmu\html\table\builders\VariableSingleBuilder as VariableSingleBuilder;
    //Global include file
    include_once '../code/whois.conf';
    //get the $_POST or $_GET arrays and convert to variables function
    include_once '../code/variables_from_array.inc';

    //TABLE TEST

$tablearray = array (

    'row1' => array (

       'col1' => array    (         
                                     'class' => "classvalue",
                                     'tddata' =>  "12345678"
                        ),



        'col2' => array    (       
                                     'id'   =>  "id_override",       
                                    'tddata' =>  "abcde"
                        ),

        'col3' => array    (       
                                     'id2'   =>  "id_override",       
                                    'tddata' =>  "xyz"
                        )
                                                                        ),//close TABLEARRAY

    'row11' => array (

       'col1' => array    (         
                                     'class' => "classvalue",
                                     'tddata' =>  "NAME"
                        ),



        'col2' => array    (       
                                     'id'   =>  "id_override",       
                                    'tddata' =>  "abcde"
                        ),

        'col3' => array    (       
                                     'id2'   =>  "id_override",       
                                    'tddata' =>  "xyz"
                        )
                                                                        ),//close TABLEARRAY


    'row21' => array (

        'col1' => array    (         
                                     'class' => "classvalue",
                                     'tddata' =>  "NAME"
                        ),



        'col2' => array    (       
                                     'id'   =>  "id_override",       
                                    'tddata' =>  "abcde"
                        ),

        'col3' => array    (       
                                     'id'   =>  "id_override",       
                                    'tddata' =>  "xyz"
                        )
                                
                                                                        
                                                                         ),//close TABLEARRAY
                                                                           
    'row2' => array (

        'col1' => array    (         
                                     'class' => "classvalue",
                                     'tddata' =>  "NAME"
                        ),



        'col2' => array    (       
                                     'id'   =>  "id_override",       
                                    'tddata' =>  "euryt"
                        ),

        'col3' => array    (       
                                     'id'   =>  "id_override",       
                                    'tddata' =>  "data"
                        )

                                
                                                                        
                                                                         ),//close TABLEARRAY
    'row3' => array (

        'col1' => array    (         
                                     'class' => "classvalue",
                                     'tddata' =>  "NEW"
                        ),



        'col2' => array    (       
                                     'id'   =>  "id_override",       
                                    'tddata' =>  "else"
                        ),

        'col3' => array    (       
                                     'id'   =>  "id_override",       
                                    'tddata' =>  "fklfkjfir"
                        )

                                
                                                                        
                                                                         )//close TABLEARRAY
                                                    
                                                                            );//close COMPLETETABLEARRAY

    $trarray = array (

                                    'class' => "class_overrride",
                                       'id' => "id_overrride"

                                                                        );//close

    //declare variable to hold the value of last zero iteration ID trigger below, mst be outside loop below
    $last = null;

    $table = new \cmu\html\table\products\CompositeTable; //'Singleton' only instantiate once
    $table->setClass("table");

    foreach ($tablearray as $row) {
        //opening TR
        $tr = (new VariableSingleBuilder("Tr", $trarray));

        $tr->build($table);

        $existing = ($row['col1']['tddata'] == $last) ? 1 : null ;  //do we have a new ID?

        $last = $row['col1']['tddata'];

        
        //counter for iteration below, keeping track of associative array with numerical counter, resets at each new row ($row)
 
        


       $i = 0;
      

        foreach ($row as $cell) {
            
            //$last = $row['col1']['tddata'];							//set $last

            if (!isset($existing) || $i >= $emptycells) {
            // print out full row, we DONT HAVE existing ID trigger, print full row
                (new VariableSingleBuilder("Td", $cell))->build($table);
            //EXISTING is set, we have existing ID trigger
            } elseif ($i == 0) {
                //print empty cell colspan
                (new VariableSingleBuilder('Td', array('colspan' => $emptycells, 'class' => 'blank')))->build($table);
            
            }

            //else, skip printing!!!

            
            $i++;

        }
         //Closing TR
        (new VariableSingleBuilder ("CloseTag", array('tag' => 'tr')))->build($table);

    }

    //print_r($td->display);

    echo $table->returnHtml();



    $form = new \cmu\html\form\products\CompositeForm; //'Singleton' only instantiate once
    $form->setClass("form");

   //// print_r($_POST);


   //METAARRAY for PERSON


    $select =       array('label' => 'Something',
                          'class' => 'classvalue',
                     'filtertype' => 'all',
                            'alt' => 'altvalue',
                           'type' => 'select',
                      'reqnumber' => 1,
                       'spanhint' => 'hint',
                        'builder' => "select",
                           'name' => 'select',
                   'optionsarray' => array ('optiontwo' => '(123)123-1234', 'optionone' => '12345')
                    
                                                );


    $textarea =       array('label' => "TextArea",
                          'class' => "classvalue",
                     'filtertype' => "all",
                            'alt' => "altvalue",
                        'builder' => "textarea",
                           'name' => "textarea",
                      'reqnumber' => 1,
                       'spanhint' => " hint",
                           'wrap' => 'soft'
                                                );

    $radio=         array('label' => "Something",
                          'class' => "classvalue",
                     'filtertype' => "all",
                            'alt' => "altvalue",
                           'type' => "radio",
                        'builder' => "radio",
                           'name' => "radio",
                      'reqnumber' => 1,
                       'spanhint' => " hint",
                   'optionsarray' => array ('optiontwo' => '(123)123-1234', 'optionone' => '12345')
                    
                                                );


        $checkbox = array('label' => "Something",
                          'class' => "classvalue",
                     'filtertype' => "all",
                            'alt' => "altvalue",
                           'type' => "checkbox",
                        'builder' => "checkbox",
                           'name' => "checkbox",
                      'reqnumber' => 2,
                     'legendname' => 'Phone Number',
                'compusermessage' => "Must select 2 or more",
                   'optionsarray' => array ('optiontwo' => '(123)123-1234', 'optionone' => '12345')
                    
                                                );

          $datalist = array('label' => "Phone",
                          'class' => "classvalue",
                     'filtertype' => "phone",
                            'alt' => "altvalue",
                           'type' => "text",
                        'builder' => "text_datalist",
                           'name' => "datalist",
                      'reqnumber' => 1,
                       'sanitize' => 'phone',
                       'spanhint' => " xxx-xxx-xxxx",
                   'optionsarray' => array ('optiontwo' => '123-123-1234', 'optionone' => '12345')
                    
                                                );

         $textbox = array('label' => "URL",
                          'class' => "classvalue",
                     'filtertype' => "url",
                            'alt' => "altvalue",
                           'type' => "text",
                        'builder' => "textbox",
                           'name' => "textbox",
            		   'sanitize' => 'add_http',
                      'reqnumber' => 1,
                    'placeholder' => "http://somesite.com"
                    
                                                );


             print_r($_POST);                                   

if (isset($_POST)) {
	//Grab POST values submitted to page, may be new from table or form submit
    foreach ($_POST as $k => $values) {

        if ($k != 'action') {

            ${$k}['values'] = $values;

        }

        //echo "<br />";

     }   

}
   
    //print_r($_POST);

    //$action = array ('name' => 'action', 'value'=>'update', 'type'=>'hidden');

    //use \cmu\html\form\builders\TextDatalistBuilder as TextDatalistBuilder;

    //$valuesarray = array( 'optiontwo' => '(123)123-1234', 'optionone' => '12345');

    //$valuesarray = null;

    $test = new \cmu\html\form\builders\CompositeTextareaBuilder($textarea);

    $test->build($form);

    ////$test->composite->appendGlobalAttributeByObject('class', 'Label', 'globalsetter');
    

    $text = (new \cmu\html\form\builders\CompositeSelectBuilder($select))->build($form);

    //$select = new \cmu\html\form\builders\SelectBuilder($metaarray, $valuesarray);

    //$select->build();

    ////radio
    $radio = (new \cmu\html\form\builders\CompositeRadioBuilder($radio))->build($form);

    ////textarea
    $checkbox = (new \cmu\html\form\builders\CompositeCheckboxBuilder($checkbox))->build($form);
	//datalist
    $datalist = (new \cmu\html\form\builders\CompositeTextDatalistBuilder($datalist))->build($form);
	//text
    $textbox = new \cmu\html\form\builders\CompositeTextboxBuilder($textbox);

    $textbox->build($form);
    //$action = new \cmu\html\form\builders\SingleInputBuilder($action);

    //$action->build();


    if (isset($_POST['action'])) {  //button has been pushed!! (button name is 'action')

            if ($form->validateForm()) {   //OK, now check validation
                echo "VALID!!";
                echo "<br  />";
               
                if (strstr($_POST['action'], 'Confirm')) { //if 'Confirm' is present in button value, we have confirmed the submit

                    echo "Processing Here...";

                    $action = strtolower($_POST['action']);
                    //below will call script (add(), update(), delete() )
                    $action = substr($action, 8);
                    //must build rdn...
                    $rdn = "ou=people,dc=mcs,dc=cmu,dc=edu";  ///testing
                    //must ADD objectCLass to new additions.

                    $values = ($_POST['action'] == 'Delete') ? null : $form->buildAndReturnPost() ;

                    $result = (new \cmu\wrappers\LdapWrapper())->$action($rdn, $values);

                    if ($result == true) {

                        echo "true";
                        header("Location: http://whois.math.cmu.edu/modify.php");
                        

                    } else {

                        echo "some error";
                        header("Location: http://whois.math.cmu.edu/modify.php");

                    }

                    return;
            
                } else {
                    //show the form with a 'confirm' button
                    $form->setCompusermessage('Please Confirm and sumbit below.');

                    if ($_POST['action'] == 'update') {  //editing
                        //UPDATE
                        makeButton('action', 'Confirm Update', 'submit', $form);
                        //DELETE
                        makeButton('action', 'Confirm Delete', 'submit', $form);

                    } else { //adding
                        //ADD
                        makeButton('action', 'Confirm Add', 'submit', $form);
                
                    }
        
                }

            } else {                                                                    //if (!$test->display->validateForm()) 
                ////errors,  show the form
                if ($_POST['action'] == 'update') {  //editing
                    //UPDATE
                    makeButton('action', 'Update', 'submit', $form);
                    //DELETE
                    makeButton('action', 'Delete', 'submit', $form);

                } else { //blank form
                    //ADD
                    makeButton('action', 'Add', 'submit', $form);

                }

               
            
            }
       
    } else { //we have taken no action yet, so either we are EDITing or ADDing          //  !isset($_POST['action']  return;
        ////show form before submiting, awaiting ACTION
        if (isset($_POST['rdn'])) {  //editing,  rdn would specify the ID of the record
            //UPDATE
            makeButton('action', 'Update', 'submit', $form);
            //DELETE
            makeButton('action', 'Delete', 'submit', $form);

        } else { //blank form
            //ADD
            makeButton('action', 'Add', 'submit', $form);

        }

     

    }
    //return the form
    echo $form->returnHtml();

?>

    </body>

</html>