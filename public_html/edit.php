<html>
    <head>
        
        <style>
        .rdn{   
            width:400px;
            color:red;
            }

        </style>

        <title>Edit</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="script.js"></script>

    </head>
    <body>

<?php
     //Global include file
    include_once '../code/whois.conf';
    //get the $_POST or $_GET arrays and convert to variables function
    include_once '../code/variables_from_array.inc';

    include_once '../code/people.conf';
                                              

    //if (!isset($_POST)) { 

        //$_POST = null; 

    //}


    if(null != $_POST) {
        //INJECT [value]
        foreach ($_POST as $k => $values) {

            if ($k != 'action') {             //or check to make sure only keys in array

                $person_array[$k]['values'] = $values;

            }

        }  

    }

    if (null != $_GET) {
        //do lookup and return values 

        //print_r($_GET);

        //echo $dn;

        //$dn = "ou=people, dc=mcs, dc=cmu, dc=edu";  //needs to be dynamic

        $filter="(objectClass=*)";

        $att = ['cn', 'sn', 'uid'];  //will pull same values as keys in $tablearray
        //query LDAP
        $ldap = new \cmu\wrappers\LdapWrapper();
        //build array
        $results = $ldap->getEntries($ldap->search($dn, $filter, $att));
        //(ldap)$results     [$i]     [$k]           [0]
        // arrayname        index   attribute   attributeposition (0) 
        //print_r($results);

        //echo "<br />";  echo "<br />";

        //INJECT values
        for ($i=0; $i<$results["count"]; $i++) {

            foreach ($person_array as $k => $v) {

                $ignore_array = ['userPassword', 'confirmuserPassword', 'dn'];  //ignore these values inthe array for special handling or no handling
            
                if (!in_array($k ,$ignore_array)) {

                    $person_array[$k]['values'][] = $results[$i][$k][0];  //we must input values as array as that is how builders expect them.

                }

                 $person_array['dn']['value'] =  $results[$i]['dn'];  //we can override the 'values' array and set directly ONE value

            }
    

        }

        //print_r($person_array);

    } 


    $controls = new \cmu\html\form\FormClient($person_array, $_POST);

    $controls->buildDisplay();

    echo $controls->returnDisplay();


?>



    </form>

    </body>
</html>
