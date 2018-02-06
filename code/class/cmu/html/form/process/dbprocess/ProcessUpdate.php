<?php
namespace cmu\html\form\process\dbprocess;

class ProcessUpdate extends AbstractProcess

{	

    function modify() : bool

    {

        $postarray = $this->returnpostobj->getValues();

    	$schemaarray = $this->getLdapAttributes($this->objectclasses);

        $finalpostarray = $this->removeNonAttKeys($postarray, $schemaarray);

        return (new \cmu\wrappers\LdapWrapper($this->ds))->update($this->dn, $finalpostarray);

    }

}