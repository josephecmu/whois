<?php
namespace cmu\html\form\process\dbprocess;

class ProcessDelete extends AbstractProcess

{

    function modify() : bool

    {

        return (new \cmu\wrappers\LdapWrapper($this->ds))->delete($this->dn);

    }

}