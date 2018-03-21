<?php
/*
*This is used to create a DTO and send to the Service Layer 
* 
*/

namespace cmu\html\form\commands;

use cmu\ddd\directory\infrastructure\services\dto\DTOAssembler;

class DtotoserviceCommand extends AbstractCommand

{

    function execute(CommandContext $context ) : bool

    {

        $returnpostobj = $context->get('returnpostobj');    //break out $returnpostobj from $context

        $request = $context->get('request');                //break out $request from $context

		$dto = DTOAssembler::returnDTO($returnpostobj->getValues());
	
		$action = $request->getValue('action'); 

		echo "<pre>";
		
//			print_r($returnpostobj);

		echo "<br />";

//			print_r($returnpostobj);

		echo "<br />";

		print_r($dto);


		echo "</pre>";

		//send the $action and the $dto  to the service layer


    }

}
