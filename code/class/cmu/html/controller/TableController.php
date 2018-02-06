<?php 
namespace cmu\html\controller;

class TableController extends AbstractController

{

    function process()

    {

        try {


            include_once '../code/class/cmu/html/templates/header.php';

            include_once'../code/class/cmu/html/view/displaytable.php';

            include_once '../code/class/cmu/html/templates/footer.php';


        } catch ( \Exception $e ) {


            $this->forward( '../code/class/cmu/html/view/error.php' );

        }

    }
 
}
