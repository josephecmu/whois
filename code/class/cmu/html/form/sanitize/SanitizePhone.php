<?php
namespace cmu\html\form\sanitize;

class SanitizePhone extends AbstractSanitize

{
    // convert all phone numbers to (xxx) xxx-xxxx
	public function sanitize()

    {
        //http://stackoverflow.com/questions/4708248/formatting-phone-numbers-in-php
        return preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $this->input). "\n";
        
    }

}