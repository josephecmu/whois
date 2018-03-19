<?php
/*
* This class calls the process/dbprocess Strategy classes
* It is one of the Command options for processForm() in FormClient.php
*/

namespace cmu\html\form\commands;

class DbprocessCommand extends AbstractCommand

{

    function execute(CommandContext $context ) : bool

    {

        $returnpostobj = $context->get('returnpostobj');    //break out $returnpostobj from $context

        $request = $context->get('request');                //break out $request from $context

        $dbprocess = new \cmu\html\form\process\dbprocess\ProcessContext($returnpostobj, $request);

        return $dbprocess->modifyLdap();

    }

}
