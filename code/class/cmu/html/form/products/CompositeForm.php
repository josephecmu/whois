<?php 

namespace cmu\html\form\products;

class CompositeForm extends AbstractComposite

{

    private $error = 0; 		//total errors
	private $action = "";      	//default form action empty string
	private $method = "post";  	//default method POST
    
    public function setAction( string $action_in)

	{
	
		$this->action = $action_in;
	
	}
	
	public function setMethod( string $method_in)

	{
	
		$this->method = $method_in;
	
	}
	
	public function setTarget( string $target_in)

	{
	
		$this->target = $target_in;
	
	}
	
	protected function getHtmlAction()
	
	{
	
		if (isset($this->action)) { 
        
            return  "action = '" . $this->action . "'";

        }
	
	}
	
	protected function getHtmlMethod()
	
	{
	
		if (isset($this->method)) { 
        
            return  "method = '" . $this->method . "'";

        }
	
	}
	
	protected function getHtmlTarget()
	
	{
	
		if (isset($this->target)) { 
        
            return  "target = '" . $this->target . "'";

        }
	
	}

    function getTag()    //concrete implimentation to returnHtml from AbstractComposite class.  It sets the html surrounding the composite and returns stuff inside

    {

        return "form";

    }

    private function setError()

    {

        $this->error++;

    }
    
    public function getError()

	{
	
		return $this->error;
	
	}
    
    public function returnErrorMessage()                    //overrride parent implimentation, then call parent
    
    {

        $this->setErrormessage("Form Errors: " .  $this->error );

        return parent::returnErrorMessage();

    }
    
    public function validateForm()
    
    {
    
    	$this->sanitizeForm();
    
        //turn on validate switch
        $this->setValidateSwitchOn();

        foreach ($this->components as $compositecontrol) {

            foreach ($compositecontrol->components as $leaf) {
                //only check for CONTROLS subclasses
            	//print_r($leaf);
                if (is_subclass_of($leaf, 'cmu\html\form\products\AbstractControls') && ($leaf->valueSet())) {    //check if value for field is set
                    //regex check or whatever
                    //echo "<br />";
                    //echo "LEAF iteration";
                    //echo "<br />";

                    if ($leaf->validate()) {
                         //increment compositeControl $set++ ;
                        //echo "<br />";
                        //echo "setting composite count!!";
                        //echo "<br />";
                        $compositecontrol->setCount();
                       
                    } else {
                        // increment error on form ;
                        //echo "setting LEAF error!!!!!!!!!!!!!!";
                        $this->setError();

                    }
                
                }
       
            }

            if (!$compositecontrol->validate()) { //tally up total set fields in leaves
                    //increment$form error;
                    //echo "setting composite control error!!!!!!!!!!!!!!!!!!!!!";
                    $this->setError();

            }
                //echo "<br />";
                //echo "total composite count:" . $compositecontrol->getCountSet();
                //echo "<br />";
        }

        if ($this->validate()) {

            return true;

        } 

    }
    //return self::$post array built above.
    private function returnPost()

    {

        return self::$post;

    }
    //public fascade function
    public function buildAndReturnPost()

    {

        $this->buildPost();


		return self::$post ?? null;

//        if (isset(self::$post)) { 
//
//            return $this->returnPost();
//
//        } else {
//
//            return null;
//
//        }

    }

}
