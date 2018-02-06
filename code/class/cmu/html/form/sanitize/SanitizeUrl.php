<?php
namespace cmu\html\form\sanitize;

class SanitizeUrl extends AbstractSanitize

{

	public function sanitize()

    {
        
        return (filter_var($this->input, FILTER_SANITIZE_URL));

    }

}