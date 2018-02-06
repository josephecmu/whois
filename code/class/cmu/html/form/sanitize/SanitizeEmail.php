<?php
namespace cmu\html\form\sanitize;

class SanitizeEmail extends AbstractSanitize

{

	function sanitize()

    {
        
        return (filter_var($this->input, FILTER_SANITIZE_EMAIL));

    }

}