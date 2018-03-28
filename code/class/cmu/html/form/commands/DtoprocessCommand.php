<?php
/*
*This is used to create a DTO and send to the Service Layer 
* 
*/

namespace cmu\html\form\commands;

use \cmu\html\form\process\dto\ProcessContext;

class DtoprocessCommand extends AbstractCommand

{

    function execute(CommandContext $context ) : bool

    {

        $returnpostobj = $context->get('returnpostobj');    //break out $returnpostobj from $context

        $request = $context->get('request');                //break out $request from $context

        $dtoprocess = new ProcessContext($returnpostobj, $request);

        return $dtoprocess->modifyLdap();
		
    }

}
