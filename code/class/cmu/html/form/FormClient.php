<?php
namespace cmu\html\form;

class FormClient extends \cmu\html\products\AbstractHtmlDisplayClient

{
                                               
    private $state;
    private $checkemptyarray =      ['Add', 'Update'];                           //we might public need accessors for these arrays.....
    private $confirmarray =         ['Delete'];
    private $validatearray =        ['Add', 'Update'];
	private $novalidatearray =      ['Confirm Delete'];

    function __construct($totalobj_in)            

    {

        parent::__construct($totalobj_in);

        $this->setFormState();                                                      

        $this->display = new \cmu\html\form\products\CompositeForm;

        $this->display->setClass("thisform");

        $formarray = array(  'class' => 'arrayclass',
                                'id' => 'myForm',
                            'action' => 'form.php',
                      'hintobjarray' => array(     'hintobj' => "\cmu\html\general\products\Span",
                                                       'att' => array   (   'class' => 'hint', 
                                                                         'spandata' => "__hintmessage"
                                                                        )
                                             )
                          );

        $this->display->setThisProperty($formarray);

    }

    function getState()                                                                         //used by 'buttons'

    {

        return $this->state;

    }

    private function setFormState()                                                 //used to set state of form and build buttons

    {

        if (!empty($this->request->getValue('dn'))) {                               //we have data passed

            if ( in_array($this->request->getValue('action'), $this->confirmarray))  {  // 'Confirm" is not in button, echo confirmation button

                $this->state = 'confirm';
        	        
        	} else {   

                $this->state = 'existing';                                          //data passed, but not confirm, must be existing

            }

            return;

        } 

        $this->state = 'add';                                                   //default 'add'

    }
    
    function buildForm()                                                        //BUILD

    {

        foreach ($this->totalobj->getTotalArray() as $totalarray) {
            
            $class = str_replace(' ', '',  ucwords(str_replace('_', ' ', $totalarray['builder']))); //parse out the BUILDER

            $obj = "Composite" . $class . "Builder";

            $obj = "\\cmu\\html\\form\\builders\\" . $obj;

            if (isset($totalarray['state']) && !in_array($this->state, $totalarray['state'])) {     //skip if "state" meta key and not in array.
            
                continue;                                                                           
 
            }   

            (new $obj($totalarray))->build($this->display);   //build control  //eliminate Singleton by passing same instantiated object as parameter

        }
                          
        (new \cmu\html\form\formbuttons\FormButtonsContext())->process($this);                      //Buttons Strategy
    }

    function checkChangeForm()

    {
        
        if (in_array($this->request->getValue('action'), $this->checkemptyarray)) {                 //condition to check

            if ($this->display->checkChange()) {

                return true;  

            } else {

                $this->display->setHintmessage('No Changes Made.');                                 //false, set error message

                return false;                                                                   

            }

        }   

        return true;                                                                    //default, we don't check DELETE

    }

    function validateForm()                                                             //VALIDATE

	{
		
		if (null == $this->request->getValue('action')) {                         	    //check if 'action' set (we know it was submitted)

            return false;                                                               //stop checking and return false if no ACTION     

        }

        if (in_array($this->request->getValue('action'), $this->novalidatearray)) {		//no validate, return true (deleting)
        
            return true;                                                                //exit true
        
        }

        if (in_array($this->request->getValue('action'), $this->validatearray)) {      	//see if the 'action' value is in validatearray

            if ($this->display->validateForm())  {          							//check for validation

                return true;

            } else {

                $this->display->setHintmessage('Check Form for Errors.');				//if not validate, set hintmessage

            }

        } 
            
    } 

    function processForm()                                                              //PROCESS 

    {
        //'postprocess',  <- other COMMAND object 'hook' to handle postprocessing
        $commands = ['dbprocess'];                                                      //could also be a class property member??                

        $returnpostobj = new \cmu\html\base\ReturnPost();                               //build from form objects products PARAMETERS
       
        $returnpostobj->setValues($this->display->buildAndReturnPost());                //wrap the buildAndReturnPost() array in an object

        $context = new \cmu\html\form\commands\CommandContext();                        //context for COMMAND

        $context->addParam('returnpostobj', $returnpostobj);                            //adds param of the array object of above

        $context->addParam('request',  $this->request);                                 //adds param for request object from REGISTRY in this class

        $processor = new \cmu\html\form\commands\ProcessFormDic($commands, $context);   //pass both here to DI

        return $processor->process();                                                   //return 'true' or nothing (false)

    }

}