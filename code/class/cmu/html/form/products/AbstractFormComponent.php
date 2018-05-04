<?php
namespace cmu\html\form\products;

use \cmu\html\products\AbstractProduct;

abstract class AbstractFormComponent extends AbstractProduct

{

    protected $alt = null;
    protected $name = null;
    protected $readonly = null;
    protected static $post = null;              //holds the post array to submit made by buildPost()
    protected $appendname = null;               //prepend name with brackets or other characters


    function setAlt($alt_in)

    {

        $this->alt = $alt_in ;

    }

    function setName($name_in)

    {

        $this->name = $name_in;

    }

    function setReadOnly($readonly_in)

    {

        if ($readonly_in != null) {

            $this->readonly = "readonly";
        
        }

    }

    public function getName()

    {

        return $this->name;

    }
    
    public function setAppendname($char)

    {

        $this->appendname = $char;

    }

    public function getAppenddname()

    {

        return $this->appendname;

    }

    protected function getHtmlAlt()

    {

        if (isset($this->alt)) { 
        
            return "alt = '" . $this->alt . "'";

        }

    }

    protected function getHtmlName()

    {

        if (isset($this->name)) { 
        
            return "name = '" . $this->name . $this->appendname . "'";

        }

    }

    protected function getHtmlReadonly()

    {

        if (isset($this->readonly)) { 
        
            return  $this->readonly;

        }

    }
    ///////////////////////////////////VISITORS////////////////
    
    //create inherited implimentation to avoid concrete implimentation in each leaf
    protected function sanitizeForm()
    
    {
    
    	$visitor = new \cmu\html\form\visitors\SanitizeVisitor();

        return $this->accept($visitor);
    
    }
	//create inherited VISITOR implimentation to avoid concrete implimentation in each leaf
    function getKeyValueForm()

    {
    
        $visitor = new \cmu\html\form\visitors\GetKeyValueVisitor();

        return $this->accept($visitor);

    }

    function checkChange()
    
    {
    
    	$visitor = new \cmu\html\form\visitors\CheckChangeVisitor();

        return $this->accept($visitor);
    
    }
  //////////////////END VISITORS/////////////////////////////////
/*
 * USED FOR POST PROCESSING - mimic a $_POST submission
 * This method takes the values for each object 'value' field and converts them to an array, either multi-array values or single array value (hidden)
 * It makes this decision based on whter or not brackets append the 'name'.
 * It sets the value of self::$post.
 * name: cmu\html\form\products::AbstractFormComponent::buildPost()
 * @return:null
 * 
 */
    protected function buildPost()                                      

    {
        
        if (null !== $this->getKeyValueForm()) {                                            //check if return key/value pair is empty

            $pieces = explode(';', $this->getKeyValueForm());

            $key = $pieces[0];                                                              //most likely $this->name

            $value = $pieces[1];
                                          
            if ($this->appendname == "[]") {                                                 //check if the append is '[]'                                    

                self::$post[$key][] = $value;                                                //add array of values    []

                return;                                                                     //stop and return array

            } 

            self::$post[$key] = $value;                                                      //NOT array

        }

    }

}


