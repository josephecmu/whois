<?php
namespace cmu\html\form\sanitize;

abstract class AbstractSanitize

{

    protected $input;

    function __construct($input_in)

    {

        $this->input = $input_in;

    }
    //hook each concrete implimentation will impliment
    abstract function sanitize();

    public function sanitizeInput()

    {
        
        $cleaned = $this->sanitize(); //hook
        
        return trim($cleaned);

    }

}