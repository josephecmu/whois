<?php
namespace cmu\html\form\sanitize;

class SanitizeAddHttp extends AbstractSanitize

{

	function sanitize()

    {
        
        if (substr($this->input, 0, 7) !== 'http://' && substr($this->input, 0, 8) !== 'https://' ) {

            $url = "http://" . $this->input;

        } else {

            $url = $this->input;

        }

        return $url;

    }

}