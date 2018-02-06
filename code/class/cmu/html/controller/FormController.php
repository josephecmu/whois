<?php 
namespace cmu\html\controller;

class FormController extends AbstractController

{

    function process()

    {

		include_once '../code/class/cmu/html/templates/header.php';

		include_once '../code/class/cmu/html/view/displayform.php';

		include_once '../code/class/cmu/html/templates/footer.php';

    }
 
}
