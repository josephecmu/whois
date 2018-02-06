<?php
namespace cmu\html\form\sanitize;

class SanitizeNumberfloat extends AbstractSanitize

{

	function sanitize()

    {
        
        return (filter_var($this->input, FILTER_SANITIZE_NUMBER_FLOAT));

    }

}