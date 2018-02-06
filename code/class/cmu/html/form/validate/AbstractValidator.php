<?php
namespace cmu\html\form\validate;

abstract class AbstractValidator

{

    protected $input;
    protected $validateagainst = null;
    static $errormessages = array();

    abstract function validateInput();

    function __construct($input_in, $validateagainst_in = null)

    {

        $this->input = $input_in;

        $this->validateagainst = $validateagainst_in;

        //echo $this->validateagainst;

    }

    static function getErrorMessages()

    {

        return self::$errormessages;

    }

    protected function setErrorMessage($message_in)

    {

        self::$errormessages[] = $message_in;

    }
    
    public function resetErrorMessages()                                                                //reset array

    {

        self::$errormessages = array();

    }


}