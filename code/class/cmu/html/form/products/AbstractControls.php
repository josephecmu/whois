<?php 
namespace cmu\html\form\products;

abstract class AbstractControls extends AbstractFormComponent

{   //This class is is used for all form controls (user actionable)
    /*
     *  Properties//////////////////////
     *
     */

    static $validateswitch = null;

    protected $onchange;            //dynamic

    protected $noticemessage;                 
    protected $noticeobjarray = array( 'noticeobj' => "\cmu\html\general\products\Span",

                                        'att' => array(
                                          'class' => 'notice', 
                                       'spandata' => "__noticemessage"
                                                        )

                                        );                                  //default notice wrapper att

    protected $hintmessage;
    protected $hintobjarray = array( 'hintobj' => "\cmu\html\general\products\Span",

                                    'att' => array (
                                         'class' => 'hint', 
                                      'spandata' => "__hintmessage"
                                                    )
                                    	);                      //default hint wrapper att for hints next to object (DIV, SPAN, etc))

    protected $errormessage;                                                                //message to display for validation if error
    protected $errorobjarray = array( 'errorobj' => '\cmu\html\general\products\Span',

                                    'att' => array (
                                         'class' => 'error', 
                                      'spandata' => "__errormessage"
                                                    )
                                        );                                  //default wrappertag attributes
 
    /*
     *  Methods////////////////////////////
     *
     */
    
    public function setOnchange($onchange_in)

    {

        $this->onchange = $onchange_in;

    }

    public function getOnchange()

    {

        return $this->onchange;

    }

    public function getHtmlOnchange()

    {

        if (isset($this->onchange)) {

            return "onchange='" . $this->onchange . "'";

        }

    }
    /*
     *  Notice Messages
     *
     */
    public function setNoticemessage( string $noticemessage_in)

    {

        $this->noticemessage = $noticemessage_in;

    }

    public function setNoticeobjarray(array $noticeobjarray_in)

    {

        $this->noticeobjarray = $noticeobjarray_in;

    }

    public function getNoticemessge(array $noticemessage_in)

    {

        $this->noticemessage = $noticemessage_in;

    }

    public function returnNoticemessage()

    {

        if (null !== $this->noticemessage) {

            return $this->returnExternalObjectHtml($this->noticeobjarray['noticeobj'], $this->errmsgobjectarray['att']);

        }

    }
    /*
     *  Hint Messages
     *
     */
    public function setHintmessage( string $hintmessage_in)

    {

        $this->hintmessage = $hintmessage_in;

    }

    public function setHintobjarray(array $hintobjarray_in)

    {

        $this->hintobjarray = $hintobjarray_in;

    }

    public function getHintmessage()

    {

        return $this->hintmessage;

    }

    public function returnHint()

    {

        if (isset($this->hintmessage)) { 

            return $this->returnExternalObjectHtml($this->hintobjarray['hintobj'], $this->hintobjarray['att']);

        }

    }

    /*
     *  Error Messages
     *
     */
    public function setErrorobjarray(array $errorobjectarray_in)

    {
    
        $this->errorobjarray = $errorobjectarray_in;

    }

    public function setErrormessage( string $in_errormessage)

    {

        $this->errormessage = $in_errormessage;

    }

    public function getErrorMessage() 

    {

        return $this->errormessage;
        
    }

    public function returnErrorMessage()
    
    {
        //if $this->errormessage is NOT null (validator assigned value messages) return it.
        if (null !== $this->errormessage) {

            return $this->returnExternalObjectHtml($this->errorobjarray['errorobj'], $this->errorobjarray['att']);

        }

    }
    /*
     *  End Messages
     *
     */
    public function setValidateSwitchOn()

    {

        self::$validateswitch = 'on';

    }
									//create inherited implimentation to avoid concrete implimentation in each leaf
    public function validate()		//use visitor to check if certain field passes validation tests (from Strategy Pattern)

    {

        if (isset(self::$validateswitch)) {

            $visitor = new \cmu\html\form\visitors\ValidateVisitor();

            return $this->accept($visitor);

        }

        return true;                                                                    //default

    }
	//create inherited implimentation to avoid concrete implimentation in each leaf
    public function valueSet() //use visitor to check if value is set on each leaf

    {

        $visitor = new \cmu\html\form\visitors\ValueSetVisitor();

        return $this->accept($visitor);
    
    }

}